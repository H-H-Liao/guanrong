<template>
    <div>
        <div id="elevator-checkout" class="elevator"></div>
            <div class="flexCC mt-lg">
                <div class="bigtext color--primarydark">
                    商品項目與金額
                </div>
            </div>
            <div class="combocheckout">
                已選購<span>{{getCount()}}</span>項商品，還差<span>{{ getLessCount() }}</span>項商品
            </div>
            <div class="subtotal">
                小計金額<span>NT.{{sum}}</span>
            </div>
            <div class="set">
                <span class="mr-sm">活動組數</span><input type="number" min="1" class="input-style-A" v-model="want_count" required />
            </div>
            <div class="flexCC">
                <a @click="addToCart()" class="btn btn-A btn-A--gray">
                    <span class="btn-A__inner">加入購物車</span>
                    <span class="btn-A__ribbon"></span>
                </a>
            </div>
            <div class="productbox-group">
                <div  v-for="($item,$key) in list" :key="$key" class="productbox productbox--redbtn">
                    <div class="productbox__pic">
                        <div class="productbox__pic-inner" :style="'background-image: url(\''+getProductImage($item.product)+'\');'"></div>
                    </div>
                    <div class="productbox__info">
                        <div class="productbox__title">{{ $item.product.title.cht }}</div>
                        <div class="productbox__cate">{{ $item.spec.name }}</div>
                        <div class="productbox__singleprice">原售價<span>|</span><span>NT.{{ $item.spec.original_price }}</span></div>
                        <div class="productbox__input">
                            <input type="number" class="input-style-A input-style-A--small" min="1" value="1">
                        </div>
                    </div>
                    <a @click="addCart($item)" class="productbox__btn">
                        直接選購
                    </a>
                </div>
            </div>
            <div  class="productbox-group">
                <div v-for="($item,$key) in green_list" :key="$key" class="productbox productbox--greenbtn">
                    <div class="productbox__pic">
                        <div class="productbox__pic-inner" :style="'background-image: url(\''+getProductImage($item.product)+'\');'"></div>
                    </div>
                    <div class="productbox__info">
                        <div class="productbox__title">{{ $item.product.title.cht }}</div>
                        <div class="productbox__cate">{{ $item.spec.name }}</div>
                        <div class="productbox__singleprice">原售價<span>|</span><span>NT.{{ $item.spec.original_price }}</span></div>
                        <div class="productbox__input">
                            <input type="number" class="input-style-A input-style-A--small" min="1" value="1">
                        </div>
                    </div>
                    <a @click="addGreenCart($item)" class="productbox__btn">
                        直接選購
                    </a>
                </div>
            </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props:{
        model:{
            type: Object
        },
        productList:{
            type: Array
        },
    },
    data:function(){
        return {
            list:[],
            green_list:[],
            setting:null,
            type:null,
            cart:[],
            green_cart:[],
            want_count:1,
            sum:0
        }
    },
    mounted:function(){
        this.setting = JSON.parse(this.model.setting);
        this.type = this.model.type;

        if(this.type == 2){//紅配綠
            var $p_list = this.setting.product_list;
            $p_list.forEach(element => {
                if(element.color == 'red'){
                    this.list.push(this.searchProduct(element));
                }else if(element.color == 'green'){
                    this.green_list.push(this.searchProduct(element));
                }
            });
        }else{
            var $p_list = this.setting.product_list;
            $p_list.forEach(element => {
                this.list.push(this.searchProduct(element));
            });
            console.log(this.list);
        }
    },
    methods:{
        addToCart:function(){
            this.cart.forEach((element)=>{
                axios.post('/api/product',{
                    amount:1,
                    id:element.product.id,
                    spec:element.spec.name
                })
                .then((response)=>{
                    this.$store.commit('setState',true);
                })
                .catch((error)=>{
                    console.log(error)
                })
            });
             this.green_cart.forEach((element)=>{
                axios.post('/api/product',{
                    amount:1,
                    id:element.product.id,
                    spec:element.spec.name
                })
                .then((response)=>{
                    this.$store.commit('setState',true);
                })
                .catch((error)=>{
                    console.log(error)
                })
            });
        },
        getSum:function(){
            if(this.type == 2){//紅配綠
                 axios.post('/combo_api/'+this.model.id,{'product_list':this.cart})
                .then((response)=>{
                      this.sum = response.data;
                })
                .catch((error)=>{
                    console.log(error)
                    this.sum = 0;
                })
            }else if(this.type == 3){//第二件五折
                axios.post('/combo_api/'+this.model.id,{'product_list':this.cart})
                .then((response)=>{
                    this.sum = response.data;
                })
                .catch((error)=>{
                    console.log(error)
                    this.sum = 0;
                })
            }
        },
        addCart:function($item){
            this.cart.push($item);
            this.getSum();
        },
        addGreenCart:function($item){
            this.green_cart.push($item);
            this.getSum();
        },
        getCount:function(){
            var $count = this.cart.length + this.green_cart.length;
            if($count<0){
                $count = 0;
            }
            return $count;
        },
        getLessCount:function(){//給予剩餘數量
          if(this.type == 2){//紅配綠

            var $red = this.want_count - this.cart.length;
            if($red <0){
                $red = 0;
            }
            var $green =this.want_count - this.green_cart.length;
            if($green <0){
                $green = 0;
            }
            return  Math.abs($red + $green) || 0;
          }else if(this.type == 3){//查看是否為倍數
             var $c = this.want_count*2 - this.cart.length;


            if($c <0){
                $c = 0;
            }

            return $c;
          }
          return 0;
        },
        getProductImage:function($product){
            if(($product.images.length)>0){
                return '/storage/'+$product.images[0].path;
            }else{
                return '/img/img-not-found.png';
            }
        },
        searchProduct:function($element){
            var $result = null;
            this.productList.forEach(($product_item)=>{
                if($product_item.id == $element.product.id){
                    var $spec = JSON.parse($product_item.spec)

                    $spec.forEach(($spec_item)=>{

                        if($spec_item['name'] == $element.spec.name){
                            $result = {
                                'product':$product_item,
                                'spec':$spec_item
                            }
                            return ;
                        }


                    })
                    return;
                }
            })
            return $result;
        }
    }
}
</script>

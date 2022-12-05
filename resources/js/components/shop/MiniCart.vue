<template>
    <div>
            <div class="shopaside__amount">
                共(<span>{{$store.state.count}}</span>)件商品
            </div>
            <div class="shoplist">
                <div v-for="($item,$key) in cart.product_list" :key="$key" class="shopitem">
                    <div class="shopitem__data">
                        <div class="shopitem__pic">
                            <div class="shopitem__pic-inner" :style="'background-image: url(\''+$item.image_url+'\')'"></div>
                        </div>
                        <div class="shopitem__info">
                            <a :href="$item.link"  class="shopitem__name">{{$item.name}}</a>
                            <div  class="shopitem__cate">{{ $item.spec }}</div>
                            <div v-for="($promotion_item,$promotion_key) in $item.promotion" :key="$promotion_key" class="shopitem__comboname">{{ $promotion_item.title.cht }}</div>
                            <label class="flexLC">
                                <input @change="updateProduct($item)" type="number" class="shopitem__input" min="1" v-model="$item.amount" />
                                <div class="shopitem__price">NT.<span>{{ $item.price[$item.price.length-1] }}</span></div>
                            </label>
                        </div>
                    </div>
                    <a @click="deleteProduct($item)" title="移除品項" class="shopitem__deletebtn">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props:{
        locale: {
            type: String,
            default:"cht"
        },
    },
    data:function(){
        return {
            cart:{
                product_list:[],
                select_area: null,
                area_list:[],
                select_delivery:null,
                delivery_list:[],
                select_payment:null,
                payment_list:[],
                invoice:{
                    type:2,
                    number:"",
                    title:""
                },
                subtotal:100,
                delivery_charge:30,
                total:130
            },
        }
    },
    watch:{
        "$store.state.state":function(){
            if(this.$store.state.state){
                this.getCart();
                console.log('ok');
            }
        }
    },
    mounted:function(){
        this.getCart();
    },
    methods:{
        getCart:function(){
            this.isLoading = true;
            this.loadingText = "訂單資料更新中";
            axios.get('/api/cart')
            .then((response)=>{
                this.cart = response.data;
                this.isLoading = false;
                this.clacProductCount();
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        clacProductCount:function(){
            var $count = 0;
            this.cart.product_list.forEach(element => {
                $count += parseInt(element.amount);
            });

            this.$store.commit('increment',$count);
            this.$store.commit('setState',false);
        },
        updateProduct:function($item){
            this.isLoading = true;
            this.loadingText = "訂單資料更新中";
            axios.put('/api/product',{
                id: $item.id,
                amount: $item.amount,
                spec: $item.spec
            })
            .then((response)=>{
                this.cart = response.data;
                this.isLoading = false;
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        deleteProduct:function($item){
            this.isLoading = true;
            this.loadingText = "訂單資料更新中";
            console.log("刪除商品");
            axios.delete('/api/product',{data:{
                id: $item.id,
                spec: $item.spec
            }})
            .then((response)=>{
                console.log(response.data);
                this.cart = response.data;
                this.isLoading = false;
            })
            .catch((error)=>{
                console.log(error)
            })
        },
    }
}
</script>

<style scoped>

</style>

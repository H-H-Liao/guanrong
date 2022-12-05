<template>
    <div class="block-productsdetail__right">
        <!-- Start 資料送出視窗 -->
        <div v-if="isLoading" class="processwindow processwindow--fixed zindex-50 js-processwindow--open">
            <div class="processwindow__inner">
                <img class="processwindow__logo" src="/project/images/processlogo.png" alt="明香珍">
                <div class="processwindow__title">{{loadingText}}</div>
                <div class="processwindow__subtitle">請稍候</div>
                <div class="dot-group">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </div>
        <!-- End 資料送出視窗 -->

        <div class="pricelist">
            <img class="pricelist__cloud lazyload" data-src="/project/images/products/smallcloud.png" alt="飄雲圖案">
            <div class="pricelist__oldprice">NT.{{select_spec.original_price || '?'}}</div>
            <div class="pricelist__price">NT.{{select_spec.price || '?'}}</div>
        </div>
        <div class="block-productsdetail__right-inner">
            <slot></slot>
            <div class="title">規格/價格</div>
            <div class="spec-group">
                <div v-for="($item,$key) in spec_list" :key="$key" class="spec" :class="{'spec--choose' : (select_spec == $item)}" @click="selectSpec($item)" >
                    <div class="spec__name">{{$item.name}}</div>
                    <div class="spec__price">NT.{{$item.price}}</div>
                </div>
            </div>
            <div class="flexLC flexCC-md mb-md">
                <div class="title title-amount">數量</div>
                <div class="slt-styleoutter-B">
                    <div class="slt-styleoutter-B__arrow"></div>
                       <select name="" v-model="amount" id="" class="slt-style-B">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
            <div class="btn-group">
                <a @click="addCart()" class="btn btn-A btn-A--gray">
                    <span  class="btn-A__inner">加入購物車</span>
                    <span class="btn-A__ribbon"></span>
                </a>
                <a  @click="goCart()" class="btn btn-A">
                    <span class="btn-A__inner">立即購買</span>
                    <span class="btn-A__ribbon"></span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    props:{
        model:{
            type:Object,
            required: true
        }
    },
    data:function(){
        return {
            isLoading:false,
            loadingText:"",
            amount:1,
            select_spec:null,
            spec_list:[],
            cart:null
        }
    },
    mounted:function(){
        // console.log(this.model.spec);
        this.spec_list = JSON.parse(this.model.spec);
        if(this.select_spec == null){
            this.select_spec = this.spec_list[0];
        }
    },
    methods:{
        selectSpec:function($value){
            this.select_spec = $value
        },
        addCart:function(){
            this.isLoading = true;
            this.loadingText = "商品加入購物車中";
            axios.post('/api/product',{
                amount:this.amount,
                id:this.model.id,
                spec:this.select_spec.name
            })
            .then((response)=>{
                this.cart =response.data;
                this.isLoading = false;
                alert('商品已新增至購物車');
                this.$store.commit('setState',true);
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        goCart:function(){
            this.isLoading = true;
            this.loadingText = "商品加入購物車中";
            axios.post('/api/product',{
                amount:this.amount,
                id:this.model.id,
                spec:this.select_spec.name
            })
            .then((response)=>{
                this.cart =response.data;
                this.isLoading = false;
                location.href = "/cht/cart";
            })
            .catch((error)=>{
                console.log(error)
            })
        }
    }
}
</script>

<template>
    <div>
        <!-- Start Productsearcharea -->
        <div class="productsearcharea">
            <div class="container h100">
                <form class="productsearchbar form-B" :action="this.quickSearchUrl" method="GET">
                    <div class="productsearchbar__title">
                        SEARCH
                        <span>
                            快速搜尋
                        </span>
                    </div>
                    <div class="flexLC flexCCC-md mt-sm-sm-d mb-sm-sm-d">
                        <div class="slt-styleoutter-B productsearchbar__select">
                            <div class="slt-styleoutter-B__arrow"><i class="fas fa-sort-down"></i></div>
                            <select name="search_brand" id="" class="slt-style-B" v-model="select_brand">
                                <option value="">選擇分類</option>
                                <option v-for="(item,key) in this.models" :key="key" :value="item.id">{{ item.title[lang] }}</option>
                            </select>
                        </div>
                        <div class="slt-styleoutter-B productsearchbar__select">
                            <div class="slt-styleoutter-B__arrow"><i class="fas fa-sort-down"></i></div>
                            <select name="search_list" id="" v-model="select_list" class="slt-style-B">
                                <option value="">選擇品牌</option>
                                <option v-for="(item,key) in select_brand_list" :key="key" :value="item.id" >{{ item.title[lang] }}</option>
                            </select>
                        </div>
                        <div class="slt-styleoutter-B productsearchbar__select">
                            <div class="slt-styleoutter-B__arrow"><i class="fas fa-sort-down"></i></div>
                            <select name="search_product_name" id="" class="slt-style-B" v-model="select_product">
                                <option value="">選擇機種</option>
                                <option v-for="(item,key) in select_product_list" :key="key" :value="item" >{{ item }}</option>
                            </select>
                        </div>
                        <div v-if="include_years" class="slt-styleoutter-B productsearchbar__select">
                            <div class="slt-styleoutter-B__arrow"><i class="fas fa-sort-down"></i></div>
                            <select name="search_years" id="" v-model="select_years" class="slt-style-B">
                                <option value="">選擇年份</option>
                                <option v-for="(item,key) in select_years_list" :key="key" :value="item" >{{ item }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="tri">
                        <div class="tri-inner"></div>
                        <i class="fas fa-search"></i>
                        <span>搜尋</span>
                        <input type="submit" class="productsearchbar__submit" value="">
                    </div>
                </form>
            </div>
        </div>
        <!-- End Productsearcharea -->
    </div>
</template>

<script>
import axios from 'axios'

export default {
    props:{
        lang:{
            type: String
        },
        url:{
            type: String
        },
        quickSearchUrl:{
            type: String
        },
        category:{
            type: Number
        },
        brand:{
            type: Number
        },
        list:{
            type: Number
        },
        product:{
            type: Number
        },
        year:{
            type: Number
        }
    },
    data:function(){
        return {
            models:[],
            select_brand:"",
            select_list:"",
            select_product:"",
            select_years:"",
            select_brand_list:[],
            select_product_list:[],
            select_years_list:[],
            include_years:false
        };
    },
    mounted:function(){
        axios.get(this.url+'?c='+this.category)
        .then((response)=>{
            this.models = response.data.list;
            this.include_years = response.data.include_years;
            if(this.brand>0){
                this.select_brand = this.brand;
            }
            if(this.list>0){
                this.select_list = this.list;
            }
            //this.select_product = this.product;
        })
        .catch((error)=>{
            console.log(error)
        })
    },
    watch:{
        select_brand:function(){
            this.getBrandList();
        },
        select_list:function(){
            this.getProducts();
        },
        select_product:function(){
            this.getProductYears();
        }
    },
    methods:{
        getBrandList:function(){
            var list_models = [];
            if(this.select_brand > 0){
                this.models.forEach(element => {
                    if(element.id == this.select_brand){
                        list_models = element.child
                    }
                });

            }
            this.select_brand_list = list_models;
            if(this.hasProducts()){
            }else{
                this.select_list = "";
            }
        },
        hasProducts:function(){
            var hasValue = false;
            this.select_brand_list.forEach(element => {
                if(element.id == this.select_list){
                    hasValue = true;
                }
            });

            return hasValue
        },
        getProducts:function(){
            var list_products = [];
            if(this.select_list > 0){
                this.select_brand_list.forEach(element => {
                    if(element.id == this.select_list){
                        list_products = element.child
                    }
                });

            }

            var product_list = [];
            console.log(list_products);
            list_products.forEach((element)=>{
                    if(product_list.includes(element.title['cht'])){

                    }else{
                        product_list.push(element.title['cht'])
                    }
            });

            this.select_product_list = product_list;
        },
        getProductYears:function(){
            var list_products = [];
            if(this.select_list > 0){
                this.select_brand_list.forEach(element => {
                    if(element.id == this.select_list){
                        list_products = element.child
                    }
                });

            }

            var years_list = [];
            list_products.forEach((element)=>{
                console.log(element);
                if(element.years){
                    if(years_list.includes(element.years)){

                    }else{
                        years_list.push(element.years)
                    }
                }
            });

            this.select_years_list = years_list;
        }
    }

}
</script>

<style>

</style>

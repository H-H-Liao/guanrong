<template>
     <div>
        商品選擇
        <el-select v-model="add_product" placeholder="請選擇商品" @change="add_product_spec = null">
            <el-option
            v-for="item in productList"
            :key="item.id"
            :label="item.title.cht"
            :value="item.id">
            </el-option>
        </el-select>
        規格選擇
        <el-select v-model="add_product_spec" placeholder="請選擇規格">
            <el-option
            v-for="(item,$key) in getProductSpec()"
            :key="$key"
            :label="item.name"
            :value="item.name">
            </el-option>
        </el-select>

        <input hidden name="product_id" type="number" v-model="add_product" />
        <input hidden name="spec" type="text" v-model="add_product_spec" />
    </div>
</template>

<script>
export default {
    props:{
        productList: {
            type: Array,
            default: []
        },
        product:{
            type: Number
        },
        spec:{
            type: String
        }
    },
    mounted:function(){
        if(this.product){
            this.add_product = this.product;
        }
        if(this.spec){
            this.add_product_spec = this.spec;
        }
    },
    data:function(){
        return {
            add_product:null,
            add_product_spec:null,
        }
    },
    methods:{
        getProduct:function(){
            var $product = null;

            this.productList.forEach((element)=>{
                if(this.add_product == element.id){
                    $product = element;
                    return;
                }
            });
            return $product
        },
        getProductSpec:function(){
            if(this.add_product){
                var $product = this.getProduct();

                return  JSON.parse($product.spec);
            }
            return [];
        },
    }
}
</script>

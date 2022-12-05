<template>
    <div>
        <input hidden type="number" name="type" v-model="type" />
        <el-select v-model="type" placeholder="請選擇" :disabled="typeLock">
            <el-option
            v-for="item in options"
            :key="item.value"
            :label="item.label"
            :value="item.value">
            </el-option>
        </el-select>
        (假如選擇免運優惠，請排序於所有促銷的最後面)
        <free-shipping v-if="type == 1" :promotion-list="promotionList" :payment-list="paymentList" :delivery-list="deliveryList" :model="model"></free-shipping>
        <color-discount v-else-if="type == 2"  :promotion-list="promotionList" :payment-list="paymentList" :delivery-list="deliveryList" :model="model"></color-discount>
        <price-discount  v-else-if="type == 3"  :promotion-list="promotionList" :payment-list="paymentList" :delivery-list="deliveryList" :model="model"></price-discount>
        <amount-discount  v-else-if="type == 4"  :promotion-list="promotionList" :payment-list="paymentList" :delivery-list="deliveryList" :model="model"></amount-discount>
    </div>
</template>

<script>
import ColorDiscount from './ColorDiscount.vue'
import FreeShipping from './FreeShipping.vue'
import PriceDiscount from './PriceDiscount.vue';
import AmountDiscount from './AmountDiscount.vue';

export default {
    props:{
        promotionList:{
            type: Array,
            default:[]
        },
        paymentList:{
            type: Array,
            default:[]
        },
        deliveryList:{
            type: Array,
            default:[]
        },
        model:{
            type: Object,
        },
        locale: {
            type: String,
            default:"cht"
        },
    },
  components: { FreeShipping, ColorDiscount, PriceDiscount, AmountDiscount },
  mounted:function(){
      if(this.model){
        console.log(this.model);
        this.type = this.model.type;
        this.typeLock = true;
      }else{

      }
  },
  data:function(){
      return {
        typeLock:false,
        type:4,
        options:[
            {
                value:1,
                label:"免運費"
            },
            {
                value:2,
                label:"紅配綠"
            },
            {
                value:3,
                label:"第2件半價"
            },
            {
                value:4,
                label:"滿N件特惠價"
            }
        ]
      }
  }

}
</script>

<style>

</style>

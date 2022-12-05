<template>
    <div>
        <el-collapse v-model="activeName" accordion>
            <el-collapse-item title="第ㄧ步驟:適用條件" name="1">
                <el-radio-group v-model="condition.type">
                    <el-radio label="none">無條件</el-radio>
                </el-radio-group>
            </el-collapse-item>
            <el-collapse-item title="第二步驟:目標族群" name="2">
                <el-radio-group v-model="target.type">
                    <el-radio label="all_customer">所有顧客</el-radio>
                    <el-radio label="only_member">會員</el-radio>
                </el-radio-group>
            </el-collapse-item>
            <el-collapse-item title="第三步驟:活動日期" name="3">
                   <el-date-picker
                    v-model="promotion_datetime"
                    type="datetimerange"
                    range-separator="至"
                    start-placeholder="開始日期"
                    end-placeholder="結束日期">
                    </el-date-picker>
            </el-collapse-item>
            <el-collapse-item title="第四步驟:商品選擇" name="4">
                <el-form :inline="true"  class="demo-form-inline">
                    <el-form-item label="商品選擇">
                        <el-select v-model="add_product" placeholder="請選擇商品" @change="add_product_spec = null">
                        <el-option
                        v-for="item in product_list"
                        :key="item.id"
                        :label="item.title.cht"
                        :value="item.id">
                        </el-option>
                    </el-select>
                    </el-form-item>
                    <el-form-item label="規格選擇">
                        <el-select v-model="add_product_spec" placeholder="請選擇規格">
                        <el-option
                        v-for="(item) in getProductSpec()"
                        :key="item"
                        :label="item.name"
                        :value="JSON.stringify(item)">
                        </el-option>
                    </el-select>
                    </el-form-item>
                    <el-form-item label="顏色">
                        <el-select v-model="add_color" placeholder="請選擇顏色">
                            <el-option
                            v-for="item in color_options"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item>
                                 <el-button @click="addRow()">新增商品</el-button>
                    </el-form-item>
                    </el-form>
                <el-table
                    :data="select_product">
                    <el-table-column
                        label="商品名稱"
                        width="180">
                        <template slot-scope="scope">
                            {{scope.row.product.title[locale]}}
                        </template>
                    </el-table-column>
                      <el-table-column
                        label="商品規格"
                        width="180">
                        <template slot-scope="scope">
                               {{scope.row.spec.name}}
                        </template>
                    </el-table-column>
                    <el-table-column
                        label="顏色"
                        width="180">
                        <template slot-scope="scope">
                            <span v-if="scope.row.color == 'red'">紅</span>
                            <span v-else-if="scope.row.color == 'green'">綠</span>
                        </template>
                    </el-table-column>
                    <el-table-column
                        label="原價"
                        width="180">
                        <template slot-scope="scope">
                            {{scope.row.spec.original_price}}
                        </template>
                    </el-table-column>
                    <el-table-column
                        label="價格">
                        <template slot-scope="scope">
                             {{scope.row.spec.price}}
                        </template>
                    </el-table-column>
                    <el-table-column
                        label="功能">
                        <template slot-scope="scope">
                            <el-button @click="removeRow(scope.row)" type="warning" plain>刪除</el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-collapse-item>
            <el-collapse-item title="第五步驟:折扣條件" name="5">
                <el-radio-group v-model="discount.type">
                    <el-radio label="fixed">固定價格</el-radio>
                    <el-radio label="50off">第二件半價</el-radio>
                </el-radio-group>
                <div v-if="discount.type=='fixed'">
                        <el-input placeholder="請輸入金額" v-model="discount.price">
                            <template slot="prepend">每組</template>
                            <template slot="append">元</template>
                        </el-input>
                    </div>
            </el-collapse-item>
          <el-collapse-item title="第五步驟:排除的促銷活動(排除的活動是前面已套用的促銷)" name="6">
                <el-select v-model="exclude_promotions" multiple placeholder="請選擇">
                    <el-option
                    v-for="item in promotionList"
                    :key="item.id"
                    :label="item.title[locale]"
                    :value="item.id">
                    </el-option>
                </el-select>
            </el-collapse-item>
            <el-collapse-item title="第六步驟:排除的運送方式" name="7">
                  <el-select v-model="exclude_deliverys" multiple placeholder="請選擇">
                    <el-option
                    v-for="item in deliveryList"
                    :key="item.id"
                    :label="item.title[locale]"
                    :value="item.id">
                    </el-option>
                </el-select>
            </el-collapse-item>
            <el-collapse-item title="第七步驟:排除的付款方式" name="8">
                  <el-select v-model="exclude_payments" multiple placeholder="請選擇">
                    <el-option
                    v-for="item in paymentList"
                    :key="item.id"
                    :label="item.title[locale]"
                    :value="item.id">
                    </el-option>
                </el-select>
            </el-collapse-item>
        </el-collapse>
        <!-- 條件 -->
        <input hidden type="text" name="condition" :value="getConditionJSON()">
        <!-- 目標族群 -->
        <input hidden type="text" name="target" :value="getTargetJSON()">
        <!-- 開放時間 -->
        <input hidden type="text" name="start_date" :value="getStartDateJSON()">
        <input hidden type="text" name="end_date" :value="getEndDateJSON()">
        <!-- 排除的促銷方式 -->
        <input hidden type="text" name="exclude_promotions" :value="getExcludePromotionJSON()">
        <!-- 排除的付款方式 -->
        <input hidden type="text" name="exclude_payments" :value="getExcludePaymentJSON()">
        <!-- 排除的運送方式 -->
        <input hidden type="text" name="exclude_deliverys" :value="getExcludeDeliveryJSON()">
        <!-- 其他設定 -->
        <textarea hidden name="setting" :value="getSettingJSON()"></textarea>
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';

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
    data() {
      return {
        promotion_datetime:[moment(),moment()],
        condition:{
                    type:"none",
                    limit:0
                },
        target:{
                    type:"only_member"
                },
        discount:{
            type:"fixed",
            price:0
        },
        activeName: '1',
        radio:"3",
        exclude_promotions:[],
        exclude_payments:[],
        exclude_deliverys:[],
        product_list:[],
        add_product:null,
        add_product_spec:null,
        select_product:[],
        add_color:null,
        color_options:[
            {
                value:"red",
                label:"紅"
            },
            {
                value:"green",
                label:"綠"
            }
        ]
      };
    },
    mounted:function(){
        if(this.model){
            this.condition = JSON.parse(this.model.condition);
            this.target = JSON.parse(this.model.target);
            this.promotion_datetime = [this.model.start_date,this.model.end_date];
            this.exclude_promotions = JSON.parse(this.model.exclude_promotions);
            this.exclude_payments = JSON.parse(this.model.exclude_payments);
            this.exclude_deliverys = JSON.parse(this.model.exclude_deliverys);
            const setting_json = JSON.parse(this.model.setting);
            this.select_product = setting_json.product_list;
            this.discount = setting_json.discount;
        }else{
        }
        axios.get('/admin/api/product')
        .then((response)=>{
            const $list = response.data;
            $list.forEach(element => {
                this.product_list.push(element)
            });
        })
        .catch((error)=>{
            console.log(error)
        })
    },
    methods:{
        getProduct:function(){
            var $product = null;

            this.product_list.forEach((element)=>{
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
        getConditionJSON:function(){
            return JSON.stringify(this.condition);
        },
        getTargetJSON:function(){
            return JSON.stringify(this.target);
        },
        getStartDateJSON:function(){
            if(this.promotion_datetime.length == 2){
                return moment(this.promotion_datetime[0]).format('YYYY-MM-DD HH:mm:ss');
            }else{
                return "";
            }
        },
        getEndDateJSON:function(){
            if(this.promotion_datetime.length == 2){
                return moment(this.promotion_datetime[1]).format('YYYY-MM-DD HH:mm:ss');
            }else{
                return "";
            }
        },
        getExcludePromotionJSON:function(){
            return JSON.stringify(this.exclude_promotions);
        },
        getExcludePaymentJSON:function(){
            return JSON.stringify(this.exclude_payments);
        },
        getExcludeDeliveryJSON:function(){
            return JSON.stringify(this.exclude_deliverys);
        },
        getSettingJSON:function(){
            return JSON.stringify({ 'product_list':this.select_product,'discount':this.discount})
        },
        addRow:function(){
            if(this.add_color == null || this.add_product_spec == null || this.add_product == null ){
                alert('請選擇所有選項');
            }else{
                this.select_product.push({
                    product:this.getProduct(),
                    spec:JSON.parse(this.add_product_spec),
                    color:this.add_color
                });
                this.add_color = null;
                this.add_product_spec = null;
                this.add_product = null;
            }
        },
        removeRow:function($value){
            this.select_product.forEach((element,$key) => {
                if(element == $value){
                    this.select_product.splice($key,1);
                    return;
                }
            });
        },
    }
}
</script>

<style scoped>

</style>

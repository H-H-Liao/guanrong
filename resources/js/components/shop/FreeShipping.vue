<template>
    <div>
        <el-collapse v-model="activeName" accordion>
            <el-collapse-item title="第ㄧ步驟:適用條件" name="1">
                    <el-radio-group v-model="condition.type">
                        <el-radio label="none">無條件</el-radio>
                        <el-radio label="full">滿額</el-radio>
                    </el-radio-group>
                    <div v-if="condition.type=='full'">
                        <el-input placeholder="請輸入金額" v-model="condition.limit">
                            <template slot="prepend">滿額</template>
                            <template slot="append">元</template>
                        </el-input>
                    </div>
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
            <el-collapse-item title="第四步驟:排除的促銷活動(排除的活動是前面已套用的促銷)" name="5">
                <el-select v-model="exclude_promotions" multiple placeholder="請選擇">
                    <el-option
                    v-for="item in promotionList"
                    :key="item.id"
                    :label="item.title[locale]"
                    :value="item.id">
                    </el-option>
                </el-select>
            </el-collapse-item>
            <el-collapse-item title="第五步驟:排除的運送方式" name="6">
               <el-select v-model="exclude_deliverys" multiple placeholder="請選擇">
                    <el-option
                    v-for="item in deliveryList"
                    :key="item.id"
                    :label="item.title[locale]"
                    :value="item.id">
                    </el-option>
                </el-select>
            </el-collapse-item>
            <el-collapse-item title="第六步驟:排除的付款方式" name="7">
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
import axios from 'axios'
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
    data:function(){
        return {
            activeName: '1',
            loading:false,
            condition:{
                        type:"none",
                        limit:0
                    },
            target:{
                        type:"only_member"
                    },
            promotion_datetime:[moment(),moment()],
            exclude_promotions:[],
            exclude_payments:[],
            exclude_deliverys:[],
        }
    },
    mounted:function(){
        if(this.model){
            console.log(this.model);
            this.condition = JSON.parse(this.model.condition);
            this.target = JSON.parse(this.model.target);
            this.promotion_datetime = [this.model.start_date,this.model.end_date];
            this.exclude_promotions = JSON.parse(this.model.exclude_promotions);
            this.exclude_payments = JSON.parse(this.model.exclude_payments);
            this.exclude_deliverys = JSON.parse(this.model.exclude_deliverys);
        }else{
        }
    },
    methods:{
        getValue:function(){
            if(this.id>0){
                this.isRefresh=true;
                axios.get('/admin/api/promotion/free-shipping/'+this.id)
                .then((response)=>{

                    var $data=response.data;
                    console.log($data);
                    this.name=$data.title;
                    this.condition=JSON.parse($data.condition);

                    this.target=JSON.parse($data.target);
                    this.start_date=$data.start_date;
                    this.end_date=$data.end_date;
                    this.no_end_date=$data.no_end_date;
                    this.payment_item=JSON.parse($data.payments);
                    this.delivery_item=JSON.parse($data.deliverys);

                    this.isRefresh=false;
                })
                .catch((error)=>{
                    this.isRefresh=false;
                });
            }
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
            var $json = {};

            return JSON.stringify($json)
        },
    }
}
</script>

<style>
    .refresh{
        background-color: rgba(200, 200, 200, 0.5);
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: 10000;
        color: white;
        font-size: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

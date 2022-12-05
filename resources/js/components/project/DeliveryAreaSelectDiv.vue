<template>
    <div>
        <div hidden>
            <textarea name="area" :value="JSON.stringify(list)">
            </textarea>
        </div>
        <div class="add_button_box">
            <div class="add_button" @click="addItem">增加配送區域({{ remaining }}/{{ max }})</div>
        </div>
        <div v-for="($item,$key) in list" :key="$item.id" class="card">
            <div>
                <delivery-area-select :key="$key" :area-id="$key" :value="$item.delivery_area" v-on:change="updateArea">
                </delivery-area-select>
                <el-button @click="addRow($item)">新增</el-button>
                <el-table
                :data="$item.rule">
                <el-table-column
                    label="最小數量"
                    width="180">
                    <template slot-scope="scope">
                        <el-input-number size="small" v-model="scope.row.min" :min="0" ></el-input-number>
                    </template>
                </el-table-column>
                <el-table-column
                    label="最大數量"
                    width="180">
                    <template slot-scope="scope">
                        <el-input-number size="small" v-model="scope.row.max" :min="0" ></el-input-number>
                    </template>
                </el-table-column>
                <el-table-column
                    label="運費">
                    <template slot-scope="scope">
                        <el-input-number size="small" v-model="scope.row.shipping" :min="0" ></el-input-number>
                    </template>
                </el-table-column>
                <el-table-column
                    label="功能">
                    <template slot-scope="scope">
                        <el-button @click="removeRow($item,scope.row)" type="warning" plain>刪除</el-button>
                    </template>
                </el-table-column>
                </el-table>
            </div>
            <div @click="removeItem($key)">刪除</div>
        </div>
    </div>
</template>

<script>
import DeliveryAreaSelect from './DeliveryAreaSelect.vue';

export default {
    components:{
        DeliveryAreaSelect
    },
    props:{
        content:{
            type:Array,
            default:[]
        }
    },
    data:function(){
       return {
           max:10,
           list:[],
       }
    },
    methods:{
        addRow:function($value){
            $value.rule.push({
                min:0,
                max:0,
                shipping:0
            });
        },
        removeRow:function($value,$value2){
            $value.rule.forEach((element,$key) => {
                if(element == $value2){
                    $value.rule.splice($key,1);
                    return;
                }
            });
        },
        addItem:function(){
            if(this.remaining<this.max){
                var $obj={
                    delivery_area:[],
                    rule:[]
                };
                this.list.push($obj);

            }
        },
        removeItem:function(key){
            if(confirm("確定要刪除？")){
                Vue.delete(this.list,key);
            }
        },
        updateArea:function($value){
            Vue.set(this.list[$value.key], 'delivery_area', $value.data)
        }
    },
    mounted:function(){
        this.list = this.content;
    },
    computed:{
        remaining:function(){
            if(this.list.length>=0){
                return this.list.length;
            }else{
                return this.max;
            }
        }
    }
}
</script>

<style scoped>
    .card{
        background-color: beige;
        padding: 24px;
        margin-bottom: 12px;
        display: flex;
    }
    .add_button_box{
        display: flex;
        justify-content: right;
        padding:8px;
    }
    .add_button{
        border: black 1px solid;
        cursor: pointer;
        width: fit-content;
        padding:8px;
    }
</style>

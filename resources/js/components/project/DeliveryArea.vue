<template>
    <div>
        <div class="add_button_box">
            <div class="add_button" @click="addItem">增加配送區域({{ remaining }}/{{ max }})</div>
        </div>
        <div v-for="($item,$key) in list" :key="$item.id" class="card">
            <input type="hidden" name="area_id[]" v-model="$item.id">
            <div>
                <delivery-area-select :key="$key" :area-id="$key" :value="$item.delivery_area" v-on:change="updateArea">
                </delivery-area-select>
                運費
                <input type="number" v-model="$item.shipping" @change="updateItem($key)" >
            </div>
            <div @click="removeItem($key)">刪除</div>
        </div>
    </div>
</template>

<script>
import DeliveryAreaSelect from './DeliveryAreaSelect.vue';
import axios from 'axios';

export default {
    components:{
        DeliveryAreaSelect
    },
    props:{
        deliverId:{
            type:Number,
            default:0
        }
    },
    data:function(){
       return {
           url:"/admin/shopdeliveries/api/area",
           max:10,
           list:[]
       }
    },
    methods:{
        addItem:function(){
            if(this.remaining<this.max){
                var $obj={
                    id:null,
                    shopdelivery_id:this.deliverId,
                    charging_model:1,
                    shipping:0,
                    delivery_area:['基隆市','新北市','台北市']
                };
                axios.post(this.url,$obj).then((response)=>{
                    console.log(response.data);
                    var item=response.data;
                    item.delivery_area = JSON.parse( item.delivery_area);
                    this.list.push(item);

                }).catch((error)=>{
                    console.log(error);
                });

            }
        },
        removeItem:function(key){
            if(confirm("確定要刪除？")){
                let $url=this.url+'/'+this.list[key].id;
                console.log($url);
                axios.delete($url).then((response)=>{
                    Vue.delete(this.list,key);
                }).catch((error)=>{
                    console.log(error);
                });
            }
        },
        updateItem:function(key){
            let $config=this.list[key];
            axios.post(this.url,$config).then((response)=>{
                var item=response.data;
                item.delivery_area = JSON.parse( item.delivery_area);
                this.list[key]=item;
                console.log(item);

            }).catch((error)=>{
                console.log(error);
            });
        },
        updateArea:function($value){
            Vue.set(this.list[$value.key], 'delivery_area', $value.data)
            this.updateItem($value.key);
        }
    },
    mounted:function(){
        axios.get(this.url+'/'+this.deliverId).then((response)=>{
                console.log(response.data);

                var list=response.data;
                list.forEach(element => {
                    var item=element;
                    item.delivery_area = JSON.parse(item.delivery_area);
                    this.list.push(item);
                });



            }).catch((error)=>{
                console.log(error);
            });

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

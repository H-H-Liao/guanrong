<template>
    <div>
        <div @click="changeArea()" class="change_area_button">更改配送地區</div>
        <div v-if="active_list.length>0" >
            <span v-for="($item,$key) in active_list" :key="$key">{{ $item }}
                <span v-if="$key!= (active_list.length)-1">、</span>
            </span>
        </div>
        <div v-else>
            您沒有選任何區域
        </div>
        <div class="select_dialog" v-if="show">
            選擇區域
            <div class="select_group">
                <div class="select_box">
                    <h3>不適用的區域</h3>
                   <div class="select_editor">
                       <li
                       v-for="($area_item,$area_key) in unactive_list"
                       :key="$area_key"
                       class="select_editor_item"
                       :class="{ 'active' : inArray($area_item, is_select_unactive_list)}"
                       @click="onSelectItem($area_item)">
                           <span>{{ $area_item }}</span>
                       </li>
                    </div>
                </div>
                <div class="move_button_group">
                    <div>
                        <div class="move_button" @click="moveToLeft()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                        </div>
                        <div  class="move_button" @click="moveToRight()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="select_box">

                    <h3>適用的區域</h3>
                    <div class="select_editor">
                        <li
                        v-for="($area_item,$area_key) in active_list"
                        :key="$area_key"
                        class="select_editor_item"
                        :class="{ 'active' : inArray($area_item, is_select_active_list)}"
                        @click="onSelectRightItem($area_item)">
                            <span>{{ $area_item }}</span>
                        </li>
                    </div>
                </div>
            </div>
            <div class="finish_button" @click="closeDialog()">
                完成
            </div>
        </div>
        <div class="dialog_back" v-if="show" @click="closeDialog()">

        </div>
    </div>
</template>

<script>
export default {
    props:{
        value:{
            type:Array
        },
        areaId:{
            type:Number
        }
    },
    data:function(){
        return {
            show: false,
            area_list:[
                '台灣本島',
                '離島地區',
            ],
            unactive_list:[],
            is_select_unactive_list:[],
            active_list:[],
            is_select_active_list:[],
        }
    },
    methods:{
        changeArea:function(){
            this.show=true;
        },
        closeDialog:function(){
            this.show=false;
            let obj={
                key:this.areaId,
                data:this.active_list
            };
            this.$emit('change', obj);
        },
        inArray:function($item,$list){
            let $isInArray=false;
            $list.forEach(element => {
                if($item==element){
                    $isInArray=true;
                }
            });
            return $isInArray;
        },
        removeArrayItem:function($list,$item){
            $list.forEach((element,index,$arr) => {
                if($item==element){
                    $arr.splice(index,1);
                }
            });
        },
        onSelectItem:function($item){
            let $isSelect=false;
            if(this.inArray($item,this.is_select_unactive_list)){
                $isSelect=true;
            }

            if($isSelect){
                this.removeArrayItem(this.is_select_unactive_list,$item);
            }else{
                this.is_select_unactive_list.push($item);
            }
        },
        onSelectRightItem:function($item){
            let $isSelect=false;
            if(this.inArray($item,this.is_select_active_list)){
                $isSelect=true;
            }

            if($isSelect){
                this.removeArrayItem(this.is_select_active_list,$item);
            }else{
                this.is_select_active_list.push($item);
            }
        },
        moveToRight:function(){
            this.is_select_unactive_list.forEach(element => {
                if(!this.inArray(element,this.active_list)){
                    this.active_list.push(element);
                    this.removeArrayItem(this.unactive_list,element);
                }
            });
            this.is_select_unactive_list=[];
        },
        moveToLeft:function(){
            this.is_select_active_list.forEach(element => {
                if(!this.inArray(element,this.unactive_list)){
                    this.unactive_list.push(element);
                    this.removeArrayItem(this.active_list,element);
                }
            });
            this.is_select_active_list=[];
        }
    },
    mounted:function(){
        this.area_list.forEach((element)=>{
            if(this.inArray(element,this.value)){
                this.active_list.push(element);
            }else{
                this.unactive_list.push(element);
            }
        });
    }
}
</script>

<style scoped>
    .change_area_button{
        color: cornflowerblue;
        text-decoration:underline;
        cursor: pointer;
    }
    .select_dialog{
        position: fixed;
        top:20vh;
        left:20vw;
        background-color: white;
        border-radius: 15px;
        border: solid gray 1px;
        padding:15px;
        width: 50vw;
        z-index: 1001;
    }
    .dialog_back{
        background-color: rgb(216, 216, 216,0.5);
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0px;
        left: 0px;
        z-index:1000;
    }
    .select_group{
        display: flex;
    }
    .select_box{
        width: 40%;
    }
    .finish_button{
        width: 100%;
        padding:12px;
        text-align: center;
        border: 1px solid black;
        border-radius: 10px;
        margin-top:24px;
        cursor: pointer;
    }
    .select_editor{
        border: rgb(216, 216, 216) solid 1px;
        height: 350px;
    }
    .select_editor_item{
        color:black;
        list-style: none;
    }
    .select_editor_item.active{
        background-color: royalblue;
        color: white;
    }
    .move_button_group{
        width: 20%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .move_button_group div{
        width: fit-content;
    }
    .move_button{
        margin:12px;
        font-size: 48px;
        padding:12px;
        border: rgb(216, 216, 216) solid 1px;
        text-align: center;
    }
</style>

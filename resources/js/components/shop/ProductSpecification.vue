<template>
    <div>
        <input hidden name="spec" :value="getJSON()" />
        <el-button @click="addRow()">新增</el-button>
        <el-table
        :data="tableData">
        <el-table-column
            label="規格"
            width="180">
            <template slot-scope="scope">
                <el-input v-model="scope.row.name"></el-input>
            </template>
        </el-table-column>
        <el-table-column
            label="原價"
            width="180">
            <template slot-scope="scope">
                <el-input-number size="small" v-model="scope.row.original_price" :min="0" ></el-input-number>
            </template>
        </el-table-column>
        <el-table-column
            label="價格">
             <template slot-scope="scope">
                <el-input-number size="small" v-model="scope.row.price" :min="0" ></el-input-number>
            </template>
        </el-table-column>
          <el-table-column
            label="材積計算盒數">
             <template slot-scope="scope">
                <el-input-number size="small" v-model="scope.row.box" :min="0" ></el-input-number>
            </template>
        </el-table-column>
        <el-table-column
            label="功能">
            <template slot-scope="scope">
                <el-button @click="removeRow(scope.row)" type="warning" plain>刪除</el-button>
            </template>
        </el-table-column>
        </el-table>
    </div>
</template>

<script>
export default {
    props:{
        model:{
            type: String,
        },
        locale: {
            type: String,
            default:"cht"
        },
    },
    data:function(){
        return {
            tableData:[
                {
                    name:"",
                    original_price:0,
                    price:0,
                    box:0
                }
            ]
        }
    },
     mounted:function(){
        if(this.model){
            this.tableData = JSON.parse(this.model);
        }
     },
    methods:{
        addRow:function(){
            this.tableData.push({
                name:"",
                original_price:0,
                price:0,
                box:0
            });
        },
        removeRow:function($value){
            this.tableData.forEach((element,$key) => {
                if(element == $value){
                    this.tableData.splice($key,1);
                    return;
                }
            });
        },
        getJSON:function(){
            return JSON.stringify(this.tableData);
        }
    }
}
</script>

<style>
    .el-table th{
        color:#909399 !important
    }
</style>

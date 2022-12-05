<template>
    <div>
        <v-autocomplete
        :label="label"
        chips
        clearable
        deletable-chips
        multiple
        small-chips
        v-model="selectDataList"
        :items="dataList"
        item-text="name"
        item-value="id"
        ></v-autocomplete>
         <input
            type="hidden"
            :name="name"
            v-for="($item,$key) in selectDataList"
            :key="$key"
            :value="$item"
         >
    </div>
</template>

<script>
export default {
    props:{
        list:{
            type: Array
        },
        selectList:{
            type: Array
        },
        name:{
            type: String
        },
        label:{
            type: String
        }
    },
    data:function(){
        return{
            dataList:[],
            selectDataList:[]
        }
    },
    mounted:function(){
        const self = this;
        this.list.forEach(element => {
            self.dataList.push({
                'id' : element.id,
                'name' : self.getName(element)
            });
        });
          this.selectList.forEach(element => {
            self.selectDataList.push(parseInt(element));
        });
    },
    methods:{
        getName($item){
            var $name = $item.title.cht
            if(!$name){
                $name = $item.title.en
            }
            return $name;
        }
    }
}
</script>

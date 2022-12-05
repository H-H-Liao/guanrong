<template>
    <div class="category-item">
        <category-item v-for="(item,key) in list" :key="key" :value="item" @onCategoryItemClick="itemClick" :select="select"></category-item>
    </div>
</template>
<script>
import CategoryItem from '../components/CategoryItem'
export default {
    components:{
        CategoryItem
    },props:{
        url:{
            type:String
        },
        select:{
            type:Number
        }
    }
    ,data:function(){
        return {
            list: []
        }
    },mounted:function(){
        console.log(this.url+'/category');
        const self=this;
        axios
        .get(this.url+'/category')
        .then((response) => {
            console.log(self.url+'/category');
            console.log(response.data);
            self.list=response.data;
        })
        .catch((error) => {
            alertify.error(
                error.response.data.message || this.$i18n.t('An error occurred with the data fetch.')
            );
        });
    },methods:{
        itemClick(id){
            this.$emit("onCategoryItemClick", id);
        }
    }


}
</script>


<style>

.category-item {
    margin: 28px 0
}

.category-item_icon:hover {
    opacity: 0.7;
}

.category-item_icon svg {
    color: #f88825;
    position: relative;
    top: -2px;
}

.category-item>li {
    margin: 12px 0;
    color: #f88825;
}

.category-item>li>.category-item_icon {
    cursor: pointer;
}

.category-item>li>.category-item_title {
    color: #f88825;
    margin-left: 4px;
    cursor: pointer;
}

.category-item>li>ul {
    color: black;
}

.category-item>li>ul>li {
    margin: 4px 0;
    list-style-type: circle;
    margin-left: 13px;
}

.category-item_title:hover {
    opacity: 0.8;
}

</style>

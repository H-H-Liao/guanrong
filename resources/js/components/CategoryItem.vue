<template>
    <li>
        <span class="category-item_icon" v-if="this.value.children && this.value.children.length>0" @click="toggle()" >
            <svg v-if="open"  xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-folder-minus" viewBox="0 0 16 16">
                <path d="M.5 3l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                <path d="M11 11.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                <path d="M.5 3l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
        </span>
        <span class="category-item_title" :class="{ select_color:(select==this.value.id)}" @click="itemClick">
            {{value.title}}
            <svg v-if="select==this.value.id" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
            </svg>
            </span>
        <ul v-if="open" >
            <Item :select="select" v-for="(model,key) in value.children" :key="key" :value="model" @onCategoryItemClick="itemClickItem"></Item>
        </ul>
    </li>
</template>
<script>
export default {
    name: "Item",
    props:{
        value:{
            type: Object,
            required:true
        },
        select:{
            type:Number
        }
    },data:function(){
        return {
            open:false
        }
    },methods:{
        toggle() {
            console.log(this.value.children.length);
            if (this.value.children.length) {
                this.open = !this.open;
            }
        },
        itemClick(){
            this.$emit("onCategoryItemClick", this.value.id);
        },
        itemClickItem(id){
            this.$emit("onCategoryItemClick", id);
        }
    }
}
</script>
<style>
.category-item_title{
    cursor: pointer;
}
.category-item_title.select_color{
    color: #155263;
    font-weight: 500;
}

#tab-category label {
    font-weight: 500;
    color: #002b38;
    margin: 6px 10px 0px 10px;
}

.tab-content #tab-category>div>ul>li {
    color: #f88825;
    margin-top: 12px;
    font-weight: 500;
}

.tab-content #tab-category>div>ul>ul>li {
    margin: 4px 0;
    margin-left: -22px;
}


</style>

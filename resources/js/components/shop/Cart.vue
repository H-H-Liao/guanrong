<template>
    <div>
        <!-- Start 資料送出視窗 -->
        <div v-if="isLoading" class="processwindow processwindow--fixed zindex-50 js-processwindow--open">
            <div class="processwindow__inner">
                <img class="processwindow__logo" src="/project/images/processlogo.png" alt="明香珍">
                <div class="processwindow__title">{{loadingText}}</div>
                <div class="processwindow__subtitle">請稍候</div>
                <div class="dot-group">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </div>
        <!-- End 資料送出視窗 -->
        <div   :class="{ 'is-hidden' : page != 1 }" class="container">
                <div class="step-group">
                    <div class="step">
                        <img src="/project/images/shoppingcart/step1.png" alt="確認商品與付款方式">
                        <div class="step__text">確認商品與付款方式</div>
                        <div class="step__circle step__circle--red">壹</div>
                    </div>
                    <img class="dot" src="/project/images/shoppingcart/dot.png" alt="dot">
                    <div class="step">
                        <img src="/project/images/shoppingcart/step2-0.png" alt="填寫表單">
                        <div class="step__text">填寫表單</div>
                        <div class="step__circle">貳</div>
                    </div>
                    <img class="dot" src="/project/images/shoppingcart/dot.png" alt="dot">
                    <div class="step">
                        <img src="/project/images/shoppingcart/step3-0.png" alt="訂購成功">
                        <div class="step__text">訂購成功</div>
                        <div class="step__circle">參</div>
                    </div>
                </div>

                <div v-if="loginUrl" class="flexCC">
                    <div class="bigtext">已經是會員? 按此<a class="color--primarydark u-text-600 u-hover-8" :href="loginUrl">登入</a></div>
                </div>

                <div class="block-shopping">
                    <div class="shoppinghead">訂購須知</div>
                    <div class="block-shopping__inner">
                        <div class="bigtext">購物流程</div>
                        <div class="stepbox wow fadeIn">
                            <img class="stepbox__step1" src="/project/images/order/step1.png" alt="購物流程">
                            <img class="stepbox__step2" src="/project/images/order/step2.png" alt="購物流程2">
                        </div>
                        <div class="bigthicktext color--primary">
                            急件請電話聯絡
                        </div>
                        <p><span class="bigthicktext color--primary mr-sm">大宗訂購</span>單項商品大量訂購50盒以上，需先來電確認訂單、收件日，以利出貨作業</p>
                        <p>網站訂購成功後，請先與我們聯絡並付款，確認款項與訂單無誤，我們將儘速出貨，感謝合作</p>
                    </div>
                </div>

                <article class="box">
                    <div class="flexCC mb-lg mb-md-sm-d">
                        <div class="smallheading"><img src="/project/images/headingicon.png" alt="明香珍icon" class="smallheading__img">
                            <h2 class="smallheading__text">確認商品明細</h2>
                        </div>
                    </div>
                    <div class="bigthicktext u-text-center color--primarydark">
                        共({{ cart.product_list.length }})件商品
                    </div>
                    <div class="cartlist">
                        <div class="cartlist__head">
                            <div class="cartlist__th">商品</div>
                            <div class="cartlist__th">方案</div>
                            <div class="cartlist__th">單價</div>
                            <div class="cartlist__th">數量</div>
                            <div class="cartlist__th">小計</div>
                            <div class="cartlist__th"></div>
                            <div class="cartlist__th cartlist__th--mobile">購物清單</div>
                        </div>
                        <div v-for="($item,$key) in cart.product_list" :key="$key" class="cartlist__item">
                            <div class="cartlist__name">
                                <div class="cartlist__pic">
                                    <div class="cartlist__pic-inner" :style="'background-image: url(\''+$item.image_url+'\')'"></div>
                                </div>
                                <div>
                                     <a :href="$item.link" class="cartlist__name-main">{{$item.name}}</a>
                                </div>
                            </div>
                            <div class="cartlist__cate">
                                {{ $item.spec }}
                                <div v-for="($promotion_item,$promotion_key) in $item.promotion" :key="$promotion_key" class="cartlist__cate-promote">{{ $promotion_item.title.cht }}</div>
                            </div>
                            <div class="cartlist__price"><span>原價：</span>NT.{{ $item.price[0] }}</div>
                            <div class="cartlist__num">
                                <input @change="updateProduct($item)" type="number" v-model="$item.amount" min="1" class="input-style-C">
                            </div>
                            <div class="cartlist__subtotal">
                                <div v-for="($price,$price_key) in $item.price" :key="$price_key" :class="{'cartlist__subtotal-oldprice':$price_key != ($item.price.length-1)}">NT.{{ $price * $item.amount }}</div>
                            </div>
                            <div class="cartlist__delete">
                                <a @click="deleteProduct($item)"><span>移除</span><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="box">
                    <div class="flexCC mb-lg mb-md-sm-d">
                        <div class="smallheading"><img src="/project/images/headingicon.png" alt="明香珍icon" class="smallheading__img">
                            <h2 class="smallheading__text">選擇送貨與付款方式</h2>
                        </div>
                    </div>

                    <div class="methodlist-set">
                        <div class="methodlist methodlist--locate">
                            <div class="methodlist__head">送貨地點</div>
                            <div class="methodlist__body">
                                <div class="slt-styleoutter-C">
                                    <div class="slt-styleoutter-C__arrow"></div>
                                    <select @change="setArea()" v-model="cart.select_area" class="slt-style-C">
                                        <option v-for="($item) in cart.area_list" :key="$item"  :value="$item">{{$item}}</option>
                                    </select>
                                    <div class="slt-styleoutter-C__errmsg">
                                        <!-- 宅配費用依地區不同 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="methodlist methodlist--delivery">
                            <div class="methodlist__head">送貨方式</div>
                            <div class="methodlist__body">
                                <div class="slt-styleoutter-C">
                                    <div class="slt-styleoutter-C__arrow"></div>
                                      <select  @change="setDelivery()" v-model="cart.select_delivery" class="slt-style-C">
                                        <option v-for="($item) in cart.delivery_list" :key="$item.value"  :value="$item">{{$item.title[locale]}}</option>
                                    </select>
                                </div>
                                <div class="warnmsg pl-15 mt-sm">宅配費用依地區不同</div>
                            </div>
                        </div>
                    </div>

                    <div class="methodlist-set">
                        <div class="methodlist methodlist--paymethod">
                            <div class="methodlist__head">付款方式</div>
                            <div class="methodlist__body">
                                <div class="slt-styleoutter-C">
                                    <div class="slt-styleoutter-C__arrow"></div>
                                    <div class="slt-styleoutter-C__arrow"></div>
                                    <select @change="setPayment()"  id="ATMselect" v-model="cart.select_payment" class="slt-style-C">
                                        <option v-for="($item) in cart.payment_list" :key="$item.value"  :value="$item">{{$item.title[locale]}}</option>
                                    </select>
                                    <div class="slt-styleoutter-C__errmsg">
                                    </div>
                                </div>
                                <div v-if="cart.select_payment && cart.select_payment.show_description.cht" class="ATMinfo mt-md pl-15" v-html="cart.select_payment.description.cht">
                                </div>
                            </div>
                        </div>
                        <div class="methodlist methodlist--invoice">
                            <div class="methodlist__head">發票</div>
                            <div class="methodlist__body">
                                <div class="slt-styleoutter-C">
                                    <div class="slt-styleoutter-C__arrow"></div>
                                    <select  @change="setInvoice()" v-model="cart.invoice.type" id="invoiceselect" class="slt-style-C">
                                        <option value="2">二聯式發票</option>
                                        <option value="3">三聯式發票</option>
                                    </select>
                                    <div class="slt-styleoutter-C__errmsg">
                                    </div>
                                </div>
                                <div v-if="cart.invoice.type == 3" class="invoice2box mt-md pl-15">
                                    <div>
                                        <div class="invoice2box__title">
                                            統一編號
                                        </div>
                                        <input  @change="setInvoice()" v-model="cart.invoice.number" type="text" class="input-style-B">
                                    </div>
                                    <div>
                                        <div class="invoice2box__title">
                                            公司抬頭
                                        </div>
                                        <input  @change="setInvoice()" v-model="cart.invoice.title" type="text" class="input-style-B">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flexRC mt-md">
                        <div class="checkout">
                            <div class="checkout__item">
                                <span class="checkout__title">小計｜</span><span class="checkout__price">NT.{{cart.subtotal}}</span>
                            </div>
                            <div class="checkout__item">
                                <span class="checkout__title">運費｜</span><span class="checkout__price">NT.{{cart.delivery_charge}}</span>
                            </div>
                            <div class="checkout__item">
                                <span class="checkout__title">總金額｜</span><span class="checkout__total">NT.{{cart.total}}</span>
                            </div>
                            <div v-if="cart.free_promotion">{{ cart.free_promotion.title.cht}} / 尚差 NT.{{ cart.free_promotion_sum}}</div>
                        </div>
                    </div>

                </article>

                <div class="btn-group">
                    <a href="" class="btn btn-A btn-A--gray">
                        <span class="btn-A__inner">繼續購物</span>
                        <span class="btn-A__ribbon"></span>
                    </a>
                    <a @click="nextPage()" class="btn btn-A btn-A--purple">
                        <span class="btn-A__inner">下一步</span>
                        <span class="btn-A__ribbon"></span>
                    </a>
                </div>
                <div v-if="hasExProduct()" class="flexCC mt-xxl mb-lg">
                    <div class="smallheading"><img src="/project/images/headingicon.png" alt="明香珍icon" class="smallheading__img">
                        <h2 class="smallheading__text">伴手禮加購區</h2>
                    </div>
                </div>

                <div  v-if="hasExProduct()" class="productbox-group">
                    <div v-for="($item,$key) in ex_product_list" :key="$key">
                        <div v-if="$item.product"  class="productbox">
                            <div class="productbox__pic">
                                <div class="productbox__pic-inner" style="background-image: url('/project/images/pbpic1.jpg');"></div>
                            </div>
                            <div class="productbox__info">
                                <div class="productbox__title">{{$item.product.title.cht}}</div>
                                <div class="productbox__cate">{{$item.spec}}</div>
                                <div class="productbox__price-group">
                                    <div class="productbox__oldprice">NT.{{getProductOriginalPrice($item)}}</div>
                                    <div class="productbox__price">NT.{{getProductPrice($item)}}</div>
                                </div>
                            </div>
                            <a @click="addCart($item)" class="productbox__btn">前往選購</a>
                        </div>
                    </div>
                </div>
        </div>
        <div  :class="{ 'is-hidden' : page != 2 }" class="container">

                <div class="step-group">
                    <div class="step">
                        <img src="/project/images/shoppingcart/step1.png" alt="確認商品與付款方式">
                        <div class="step__text">確認商品與付款方式</div>
                        <div class="step__circle step__circle--red">壹</div>
                    </div>
                    <img class="dot" src="/project/images/shoppingcart/dot.png" alt="dot">
                    <div class="step">
                        <img src="/project/images/shoppingcart/step2-1.png" alt="填寫表單">
                        <div class="step__text">填寫表單</div>
                        <div class="step__circle step__circle--red">貳</div>
                    </div>
                    <img class="dot" src="/project/images/shoppingcart/dot.png" alt="dot">
                    <div class="step">
                        <img src="/project/images/shoppingcart/step3-0.png" alt="訂購成功">
                        <div class="step__text">訂購成功</div>
                        <div class="step__circle">參</div>
                    </div>
                </div>

                <div class="block-shopping">
                    <div class="shoppinghead">訂購須知</div>
                    <div class="block-shopping__inner">
                        <div class="bigtext">購物流程</div>
                        <div class="stepbox wow fadeIn">
                            <img class="stepbox__step1" src="/project/images/order/step1.png" alt="購物流程">
                            <img class="stepbox__step2" src="/project/images/order/step2.png" alt="購物流程2">
                        </div>
                        <div class="bigthicktext color--primary">
                            急件請電話聯絡
                        </div>
                        <p><span class="bigthicktext color--primary mr-sm">大宗訂購</span>單項商品大量訂購50盒以上，需先來電確認訂單、收件日，以利出貨作業</p>
                        <p>網站訂購成功後，請先與我們聯絡並付款，確認款項與訂單無誤，我們將儘速出貨，感謝合作</p>
                    </div>
                </div>

                <article v-if="page == 2" class="box">
                    <div class="flexCC mb-lg mb-md-sm-d">
                        <div class="smallheading"><img src="/project/images/headingicon.png" alt="明香珍icon" class="smallheading__img">
                            <h2 class="smallheading__text">商品明細</h2>
                        </div>
                    </div>
                    <div class="bigthicktext u-text-center color--primarydark">
                        共({{ cart.product_list.length }})件商品
                    </div>
                    <div class="cartlist">
                        <div class="cartlist__head">
                            <div class="cartlist__th">商品</div>
                            <div class="cartlist__th">方案</div>
                            <div class="cartlist__th">單價</div>
                            <div class="cartlist__th">數量</div>
                            <div class="cartlist__th">小計</div>
                            <div class="cartlist__th cartlist__th--mobile">購物清單</div>
                        </div>
                        <div v-for="($item,$key) in cart.product_list" :key="$key"  class="cartlist__item">
                            <div class="cartlist__name">
                                <div class="cartlist__pic">
                                    <div class="cartlist__pic-inner" :style="'background-image: url(\''+$item.image_url+'\')'"></div>
                                </div>
                                <div>
                                    <span class="cartlist__name-main">{{$item.name}}</span>
                                </div>
                            </div>
                            <div class="cartlist__cate">{{ $item.spec }}
                        <div v-for="($promotion_item,$promotion_key) in $item.promotion" :key="$promotion_key" class="cartlist__cate-promote">{{ $promotion_item.title.cht }}</div>
                            </div>
                            <div class="cartlist__price"><span>原價：</span>NT.{{ $item.price[0] }}</div>
                            <div class="cartlist__num">
                                <span>數量：</span> {{$item.amount}}
                            </div>
                            <div class="cartlist__subtotal">
                                  <div v-for="($price,$price_key) in $item.price" :key="$price_key" :class="{'cartlist__subtotal-oldprice':$price_key != ($item.price.length-1)}">NT.{{ $price * $item.amount }}</div>
                            </div>
                        </div>
                    </div>
                </article>

                <article v-if="page == 2"  class="box">
                    <div class="flexCC mb-lg mb-md-sm-d">
                        <div class="smallheading"><img src="/project/images/headingicon.png" alt="明香珍icon" class="smallheading__img">
                            <h2 class="smallheading__text">送貨與付款方式</h2>
                        </div>
                    </div>

                    <div class="methodlist-set">
                        <div class="methodlist methodlist--locate">
                            <div class="methodlist__head">送貨地點</div>
                            <div class="methodlist__body">
                                <div class="pl-15">
                                    {{ cart.select_area }}
                                </div>
                            </div>
                        </div>
                        <div class="methodlist methodlist--delivery">
                            <div class="methodlist__head">送貨方式</div>
                            <div class="methodlist__body">
                                <div class="pl-15">
                                    {{ cart.select_delivery.title[locale] }}
                                </div>
                                <div class="warnmsg pl-15 mt-sm">宅配費用依地區不同</div>
                            </div>
                        </div>
                    </div>

                    <div class="methodlist-set">
                        <div class="methodlist methodlist--paymethod">
                            <div class="methodlist__head">付款方式</div>
                            <div class="methodlist__body">
                                <div class="pl-15 mb-md">{{ cart.select_payment.title[locale] }}</div>
                                <div v-if="cart.select_payment.memo" class="ATMinfo pl-15">
                                    {{cart.select_payment.memo}}
                                </div>
                            </div>
                        </div>
                        <div class="methodlist methodlist--invoice">
                            <div class="methodlist__head">發票</div>
                            <div v-if="cart.invoice.type == 2" class="methodlist__body">
                                <div class="pl-15 mb-md">二聯式發票</div>
                                <div class="invoice2box pl-15">
                                    <div>
                                        <div class="invoice2box__title">
                                            統一編號
                                        </div>
                                        <input type="text" class="input-style-B" value="123456" disabled>
                                    </div>
                                    <div>
                                        <div class="invoice2box__title">
                                            公司抬頭
                                        </div>
                                        <input type="text" class="input-style-B" value="123456" disabled>
                                    </div>
                                </div>
                            </div>
                            <div v-else-if="cart.invoice.type == 3" class="methodlist__body">
                                <div class="pl-15 mb-md">三聯式發票</div>
                                <div class="invoice2box pl-15">
                                    <div>
                                        <div class="invoice2box__title">
                                            統一編號
                                        </div>
                                        <input v-model="cart.invoice.number" type="text" class="input-style-B" value="123456" disabled>
                                    </div>
                                    <div>
                                        <div class="invoice2box__title">
                                            公司抬頭
                                        </div>
                                        <input v-model="cart.invoice.title" type="text" class="input-style-B" value="123456" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flexRC mt-md">
                        <div class="checkout">
                            <div class="checkout__item">
                                <span class="checkout__title">小計｜</span><span class="checkout__price">NT.{{cart.subtotal}}</span>
                            </div>
                            <div class="checkout__item">
                                <span class="checkout__title">運費｜</span><span class="checkout__price">NT.{{cart.delivery_charge}}</span>
                            </div>
                            <div class="checkout__item">
                                <span class="checkout__title">總金額｜</span><span class="checkout__total">NT.{{cart.total}}</span>
                            </div>
                            <div v-if="cart.free_promotion">{{ cart.free_promotion.title.cht}} / 尚差 NT.{{ cart.free_promotion_sum}}</div>
                        </div>
                    </div>

                </article>

                <slot></slot>

                <div class="btn-group">
                    <a @click="lastPage()" class="btn btn-A btn-A--blue">
                        <span class="btn-A__inner">回上一步</span>
                        <span class="btn-A__ribbon"></span>
                    </a>
                    <button  type="submit" class="btn btn-A">
                        <span class="btn-A__inner">確認送出</span>
                        <span class="btn-A__ribbon"></span>
                    </button>
                </div>

        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    props:{
        locale: {
            type: String,
            default:"cht"
        },
        loginUrl:{
            type: String
        }
    },
    data:function(){
        return {
            isLoading:false,
            loadingText:"",
            page:1,
            ex_product_list:[

            ],
            cart:{
                product_list:[],
                select_area: null,
                area_list:[],
                select_delivery:null,
                delivery_list:[],
                select_payment:null,
                payment_list:[],
                invoice:{
                    type:2,
                    number:"",
                    title:""
                },
                subtotal:100,
                delivery_charge:30,
                total:130
            },
        }
    },
    watch:{
         "$store.state.state":function(){
            if(this.$store.state.state){
                this.getCart();
                  console.log('state is true');
            }else{
                console.log('state is false');
            }
        }
    },
    mounted:function(){
        this.getCart();
        this.getExProduct();
    },
    methods:{
        addCart:function($item){
            this.isLoading = true;
            this.loadingText = "商品加入購物車中";
            axios.post('/api/product',{
                amount:1,
                id:$item.product_id,
                spec:$item.spec
            })
            .then((response)=>{
                alert('新增成功');
                this.getCart();
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        getExProduct:function(){
            axios.get('/api/ex_product')
            .then((response)=>{
                console.log(response.data);
                this.ex_product_list = response.data
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        getProductOriginalPrice:function($item){
            var $spec = JSON.parse($item.product.spec);
            var $price = 0;
            $spec.forEach(element => {
                if(element.name == $item.spec){
                    $price = element.original_price;
                    return ;
                }
            });
            return $price
        },
        getProductPrice:function($item){
            var $spec = JSON.parse($item.product.spec);
            var $price = 0;
            $spec.forEach(element => {
                if(element.name == $item.spec){
                    $price = element.price
                    return ;
                }
            });
            return $price
        },
        getCart:function(){
            this.isLoading = true;
            this.loadingText = "訂單資料更新中";
            axios.get('/api/cart')
            .then((response)=>{
                this.cart = response.data;
                this.isLoading = false;
                console.log(response.data);
                if(this.cart.product_list.length == 0){
                    alert("購物車至少要有一項商品");
                    location.href = '/';
                }
                // this.$store.commit('setState',false);
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        setArea:function(){
            this.isLoading = true;
            this.loadingText = "訂單資料更新中";
            axios.post('/api/area',{
                area:this.cart.select_area
            })
            .then((response)=>{
                this.cart = response.data;
                this.isLoading = false;
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        setDelivery:function(){
            this.isLoading = true;
            this.loadingText = "訂單資料更新中";
            axios.post('/api/delivery',{
                delivery:this.cart.select_delivery.id
            })
            .then((response)=>{
                this.cart = response.data;
                this.isLoading = false;
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        setPayment:function(){
            this.isLoading = true;
            this.loadingText = "訂單資料更新中";
            axios.post('/api/payment',{
                payment:this.cart.select_payment.id
            })
            .then((response)=>{
                this.cart = response.data;
                this.isLoading = false;
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        setInvoice:function(){
            this.isLoading = true;
            this.loadingText = "訂單資料更新中";
            axios.post('/api/invoice',{
                invoice:this.cart.invoice
            })
            .then((response)=>{
                this.cart = response.data;
                this.isLoading = false;
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        updateProduct:function($item){
            var $amount = 0;
            this.cart.product_list.forEach((element)=>{
                console.log(element);
                if(element.id == $item.id
                    && element.spec == $item.spec
                ){
                    console.log("same");
                    $amount += parseInt(element.amount);
                }else{
                    console.log("not same");
                }
            })

            this.isLoading = true;
            this.loadingText = "訂單資料更新中";
            axios.put('/api/product',{
                id: $item.id,
                amount: $amount,
                spec: $item.spec
            })
            .then((response)=>{
                this.cart = response.data;
                this.isLoading = false;
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        deleteProduct:function($item){

            var $amount = 0;
            this.cart.product_list.forEach((element)=>{
                if(element.id == $item.id
                    && element.spec == $item.spec
                ){
                    $amount += parseInt(element.amount);
                }else{
                }
            })
            $amount = $amount - parseInt($item.amount);

            this.isLoading = true;
            this.loadingText = "訂單資料更新中";
            console.log("刪除商品");
            axios.put('/api/product',{
                id: $item.id,
                amount: $amount,
                spec: $item.spec
            })
            .then((response)=>{
                console.log(response.data);
                this.cart = response.data;
                this.isLoading = false;
                this.getCart();
            })
            .catch((error)=>{
                console.log(error)
            })
        },
        hasExProduct:function(){
            if(this.ex_product_list.length > 0){
                return true;
            }
            return false;
        },
        nextPage:function(){
            //檢查有沒有沒填寫的數值
            this.page = 2;
            window.scroll(0,0)
        },
        lastPage:function(){
            this.page = 1;
            window.scroll(0,0)
        }
    }
}
</script>

<style scoped>

</style>

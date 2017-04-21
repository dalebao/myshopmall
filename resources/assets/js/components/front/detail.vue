<template>
    <el-row>
        <el-col :span="8">
            <high-score></high-score>
        </el-col>
        <el-col :span="16">
            <el-tabs type="border-card" style="margin-right:10px;"
                     v-loading.fullscreen.lock="loading">
                <el-tab-pane :label="item.name">
                    <el-row :gutter="10">
                        <el-col :span="12">
                            <img :src="item.img_url" alt="" style="width: 100%;display: block;">
                        </el-col>
                        <el-col :span="12">
                            <div style="display:block;">
                                <el-card class="box-card">
                                    <div slot="header" class="text item">
                                        <div style="margin-bottom: 20px;">
                                            <h3>价格：<span>{{item.now_price}}元</span></h3>
                                        </div>
                                        <hr>
                                        <div style="margin: 20px 0;">
                                            <div style="float: left;">
                                                <h3>数量：</h3>
                                            </div>
                                            <Input-number :max="item.number" :min="1" v-model="number"></Input-number>
                                        </div>
                                        <hr>

                                        <div style="margin: 10px 0;">
                                            <el-col :span="4" v-for="tag in item.tag">
                                                <Tag>
                                                    {{tag}}
                                                </Tag>
                                            </el-col>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <span style="line-height: 36px;">总价：{{item.now_price*number}}</span>
                                        <el-button style="float: right;" type="primary" @click="newOrder">生成订单
                                        </el-button>
                                    </div>
                                </el-card>
                            </div>
                        </el-col>
                    </el-row>
                    <Tabs value="item-description">
                        <Tab-pane label="商品详情" name="item-description">
                            <div class="item-description" v-html="item.description">
                            </div>
                        </Tab-pane>
                        <Tab-pane label="商品评价" name="item-comment">
                            <comment></comment>
                        </Tab-pane>
                    </Tabs>
                </el-tab-pane>
            </el-tabs>
        </el-col>
    </el-row>
</template>

<script>
    import HighScore from './highScore.vue'
    import Comment from './comment.vue'
    export default{
        components: {HighScore, Comment},
        data() {
            return {
                item: [],
                number: 1,
                total: 0,
                id: '',
                loading: true
            }
        },
        created(){
            this.fetchData()
        },
        watch: {
            // 如果路由有变化，会再次执行该方法
            '$route': 'fetchData'
        },
        methods: {
            fetchData(){
                this.id = this.$route.params.itemId
                axios.get('/api/front/item/' + this.id)
                    .then(res => {
                        this.item = res.data
                        this.loading = false
                        this.total = this.number * this.item.now_price
                    })
            },
            handleChange(price) {
//                console.log(this.number)
                this.total = this.number * price;
//                console.log(this.total)
            },
            newOrder(){
                this.$router.push({name: 'newOrder', params: {itemId: this.$route.params.itemId, itemNum: this.number}})
            }
        }
    }
</script>

<style>
    .box-card {
        margin-left: 10px;
        margin-right: 10px;
    }

    .img-style {
        padding: 0px;
        width: 400px;
    }

    .text {
        font-size: 14px;
    }

    .item {
        padding: 18px 0;
    }

    .clearfix:before,
    .clearfix:after {
        display: table;
        content: "";
    }

    .clearfix:after {
        clear: both
    }

    .box-card {
        width: 100%;
    }

    .item-description {
        font-size: 16px; /*字体大小*/
        text-indent: 2em; /*首行缩进两个单位*/
        line-height: 1.5em; /*行距为1.5个单位*/
        padding: 10px; /*用内边距代替外边距来设置段间距*/
        margin: 0; /*去掉默认的段间距*/
    }

</style>
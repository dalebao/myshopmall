<template>
    <el-row>
        <el-col :span="8">
        <high-score></high-score>
        </el-col>
        <el-col :span="16">
            <el-tabs type="border-card" style="margin-right:10px;margin-left: 10px;"
                     v-loading.fullscreen.lock="loading">
                <el-tab-pane :label="item.name">
                    <el-row>
                        <el-col :span="12">
                            <img :src="img" alt="" style="width: 100%;display: block;">
                        </el-col>
                        <el-col :span="12">
                            <div style="display:block;">
                                <el-card class="box-card">
                                    <div slot="header" class="text item">
                                        <div style="margin-bottom: 20px;">
                                            <h1>价格：<span>{{item.now_price}}元</span></h1>
                                        </div>
                                        <hr>
                                        <div style="margin: 20px 0;">
                                            <div style="float: left;">
                                                <h1>数量：</h1>
                                            </div>
                                            <Input-number :max="item.number" :min="1" v-model="number"></Input-number>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <span style="line-height: 36px;">总价：{{item.now_price*number}}</span>
                                        <el-button style="float: right;" type="primary">生成订单</el-button>
                                    </div>
                                </el-card>
                            </div>
                        </el-col>
                    </el-row>
                    <Tabs value="name1">
                        <Tab-pane label="商品详情" name="item-description"><p class="item-description">
                            {{item.description}}</p>
                        </Tab-pane>
                        <Tab-pane label="商品评价" name="item-comment">标签二的内容</Tab-pane>
                    </Tabs>
                </el-tab-pane>
            </el-tabs>
        </el-col>
    </el-row>
</template>

<script>
    import HighScore from './highScore.vue'
    export default{
        components: {HighScore},
        data() {
            return {
                item: [],
                number: 1,
                total: 0,
                id: '',
                img: 'https://img.alicdn.com/bao/uploaded/i3/TB18vZlKpXXXXbcXpXXXXXXXXXX_!!0-item_pic.jpg_250x250.jpg',
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
                console.log(this.number)
                this.total = this.number * price;
                console.log(this.total)
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
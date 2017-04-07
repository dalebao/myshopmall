<template>
    <el-row>
        <el-col :span="8">
            <el-card class="box-card">
                <div v-for="o in 4" class="text item">
                    {{'列表内容 ' + o }}
                </div>
            </el-card>
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
                                        <h1>price</h1>
                                        <hr>
                                        <h1>number</h1>
                                        <Input-number :max="item.number" :min="1" v-model="number"></Input-number>
                                    </div>
                                    <div class="clearfix">
                                        <span style="line-height: 36px;">总价：{{total}}</span>
                                        <el-button style="float: right;" type="primary">生成订单</el-button>
                                    </div>
                                </el-card>
                            </div>
                        </el-col>
                    </el-row>
                    {{item}}
                </el-tab-pane>
            </el-tabs>
        </el-col>
    </el-row>
</template>

<script>
    export default{
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

</style>
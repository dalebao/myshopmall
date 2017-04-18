<template>
    <div>
        <div>
            <h1 class="card-title">商品分类一</h1>
        </div>
        <el-row>
            <el-col :span="7" v-for="item in items" class="card-body">
                <el-card :body-style="{ padding: '0px' }">
                    <img src="https://img.alicdn.com/bao/uploaded/i3/TB18vZlKpXXXXbcXpXXXXXXXXXX_!!0-item_pic.jpg_250x250.jpg"
                         class="image">
                    <div style="padding: 14px;">
                        <p class="item_title">{{item.name}}</p>
                        <div class="bottom clearfix">
                            <!--<time class="time">{{ currentDate }}</time>-->
                            <span class="iconfont icon-costincluded">{{item.now_price}}元</span>
                            <span class="iconfont icon-costincluded">{{item.now_price}}元</span>
                            <el-button type="primary" v-on:click="showDetail(item.id)" class="button">购买商品</el-button>
                        </div>
                    </div>
                </el-card>
            </el-col>
        </el-row>
    </div>

</template>


<style>
    .time {
        font-size: 13px;
        color: #999;
    }

    .bottom {
        margin-top: 13px;
        line-height: 12px;
    }

    .button {
        /*padding: 0;*/
        float: right;
    }

    .image {
        width: 100%;
        display: block;
    }

    .clearfix:before,
    .clearfix:after {
        display: table;
        content: "";
    }

    .clearfix:after {
        clear: both
    }

    .card-title {
        margin-left: 8.33333%;
    }

    .card-body {
        margin-top: 20px;
        margin-right: 2%;
        margin-left: 2%;
    }

    .item_title {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

</style>

<script>
    export default {
        props: ['items'],
        data() {
            return {
                currentDate: new Date()
            };
        },
        methods: {
            showDetail(itemId){
                this.$router.push({name: 'detail', params: {itemId: itemId}})
            }
        }

    }
</script>
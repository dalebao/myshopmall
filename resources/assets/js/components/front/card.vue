<template>
    <div>
        <div>
            <h1 class="card-title">{{title}}</h1>
        </div>
        <el-row>
            <el-col :span="7" v-for="o in 6" class="card-body">
                <el-card :body-style="{ padding: '0px' }">
                    <img src="https://img.alicdn.com/bao/uploaded/i3/TB18vZlKpXXXXbcXpXXXXXXXXXX_!!0-item_pic.jpg_250x250.jpg"
                         class="image">
                    <div style="padding: 14px;">
                        <span>好吃的汉堡</span>
                        <div class="bottom clearfix">
                            <time class="time">{{ currentDate }}</time>
                            <el-button type="text" class="button">操作按钮</el-button>
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
        padding: 0;
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

</style>

<script>
    export default {
        data() {
            return {
                title:'热门商品',
                currentDate: new Date()
            };
        }
    }
</script>
<template>
        <el-menu class="el-menu-demo" mode="horizontal" router @select="handleSelect">
            <el-row>
                <el-col :span="6">
                    <div class="grid-content bg-purple">
                        <el-menu-item index="index">商城首页</el-menu-item>
                        <el-menu-item index="category">商品分类</el-menu-item>
                        <el-menu-item index="3">商品分类</el-menu-item>
                    </div>
                </el-col>

                <el-col :span="3">
                    <div class="nav-input">
                        <el-input v-model="input" placeholder="搜索商品"></el-input>
                    </div>
                </el-col>
                <el-col :span="3">
                    <div class="nav-search-btn">
                        <button>sss</button>
                    </div>
                </el-col>
                <el-col :span="6" :offset="6">
                    <div class="grid-content bg-purple">
                        <el-submenu index="4">
                            <template slot="title">我的工作台</template>
                            <el-menu-item index="4-1">个人管理</el-menu-item>
                            <el-menu-item index="4-2">登录</el-menu-item>
                            <el-menu-item index="4-3">退出</el-menu-item>
                        </el-submenu>
                        <el-menu-item index="5">订单详情</el-menu-item>
                    </div>
                </el-col>
            </el-row>
        </el-menu>

</template>
<style>
    .nav-input {
        margin-top: 13px;
    }

    .nav-search-btn {
        margin-top: 13px;
    }

    .nav-menu {
        /*width: 100%;*/
    }

</style>
<script>
    export default {
        name:'nav-menu',
        data() {
            return {
                input: ''
            }
        },

        methods: {
            handleSelect(key, keyPath)
            {
                console.log(key, keyPath);
            }
        }
    }
</script>

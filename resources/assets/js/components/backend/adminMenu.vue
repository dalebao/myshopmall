<template>
        <el-col :span="6">
            <div class="admin_menu">
                <el-menu mode="vertical" :default-active="active" class="el-menu-vertical-demo"
                         @select="handleSelect">
                    <el-menu-item-group title="Dash">
                        <el-menu-item index="/haso"><i class="el-icon-message"></i>DashBoard</el-menu-item>
                    </el-menu-item-group>
                    <el-menu-item-group title="订单">
                        <el-menu-item index="/haso/order_list"><i class="el-icon-message"></i>订单列表</el-menu-item>
                        <el-menu-item index="/haso/item_profit"><i class="el-icon-message"></i>订单盈利</el-menu-item>
                    </el-menu-item-group>
                    <el-menu-item-group title="商品">
                        <el-menu-item index="/haso/item_add"><i class="el-icon-message"></i>新增商品</el-menu-item>
                        <el-menu-item index="/haso/item_list"><i class="el-icon-message"></i>商品列表</el-menu-item>
                    </el-menu-item-group>
                </el-menu>
            </div>
        </el-col>

</template>

<script>
    export default{
        data(){
            return {
                active:"1"
            }
        },
        methods: {
            handleSelect(key, path){
                this.active = key
                this.$router.push({path: path['0']})
            }
        },
        created(){
            this.active = this.$route.fullPath
        }
    }
</script>

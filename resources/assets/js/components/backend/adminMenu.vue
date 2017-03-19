<template>
        <el-col :span="6">
            <div class="admin_menu">
                <el-menu mode="vertical" :default-active="active" class="el-menu-vertical-demo"
                         @select="handleSelect">
                    <el-menu-item-group title="Dash">
                        <el-menu-item index="/haso"><i class="el-icon-message"></i>DashBoard</el-menu-item>
                    </el-menu-item-group>
                    <el-menu-item-group title="订单">
                        <el-menu-item index="1"><i class="el-icon-message"></i>导航一</el-menu-item>
                        <el-menu-item index="2"><i class="el-icon-message"></i>导航二</el-menu-item>
                    </el-menu-item-group>
                    <el-menu-item-group title="商品">
                        <el-menu-item index="/haso/item_add"><i class="el-icon-message"></i>新增商品</el-menu-item>
                        <el-menu-item index="4"><i class="el-icon-message"></i>导航四</el-menu-item>
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

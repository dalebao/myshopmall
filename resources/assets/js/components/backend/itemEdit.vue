<template>
    <el-tabs type="border-card" active-name="info">
        <el-tab-pane name="info" label="商品信息编辑">
            <edit-item></edit-item>
        </el-tab-pane>
    </el-tabs>
</template>

<script>
    import EditItem from './editItem.vue'

    export default{
        components:{
            EditItem
        }
    }
</script>
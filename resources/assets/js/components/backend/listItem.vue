<template>
    <el-tabs type="border-card" active-name="info">
        <el-tab-pane name="info" label="商品信息列表">
            <item-table></item-table>
            <hr>
        </el-tab-pane>
    </el-tabs>
</template>

<script>
    import ItemTable from './itemTable.vue'

    export  default{
        components:{
            ItemTable
        }
    }
</script>
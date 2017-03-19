<template>
    <el-tabs type="border-card" active-name="info">
        <el-tab-pane name="info" label="商品信息列表">
            <item-table></item-table>
            <hr>
            <paginate></paginate>
        </el-tab-pane>
    </el-tabs>
</template>

<script>
    import ItemTable from './itemTable.vue'
    import Paginate from '../utils/paginate.vue'

    export  default{
        components:{
            ItemTable,
            Paginate
        }
    }
</script>
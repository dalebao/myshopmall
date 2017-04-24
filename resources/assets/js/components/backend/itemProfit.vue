<template>
    <div>
        <el-table
                :data="profit"
                height="400"
                border
                style="width: 100%">
            <el-table-column
                    prop="order_id"
                    label="订单号"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="one_profit"
                    label="单件利润"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="total_profit"
                    label="订单利润"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="user"
                    label="买家"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="item_title"
                    label="商品">
            </el-table-column>

        </el-table>
        <div style="margin:10px">
            <div style="float:left;">
                <h3>总订单数：{{number}}条 &nbsp;&nbsp;</h3>
            </div>
            <div>
                <h3>总利润：{{total}}元</h3>
            </div>
        </div>
    </div>
</template>


<script>
    export default{
        data(){
            return {
                profit: [],
                total: '',
                number: ''
            }
        },
        created(){
            axios.get('/api/showProfit').then(res => {
                this.profit = res.data.data
                this.total = res.data.total_profit
                this.number = res.data.total_number
            })
        }
    }


</script>
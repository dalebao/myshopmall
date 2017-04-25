<template>
    <div>

        <el-table
                :data="data.data"
                border
                style="width: 100%"
                max-height="800">
            <el-table-column
                    fixed
                    prop="order_id"
                    label="订单ID"
                    width="150">
            </el-table-column>
            <el-table-column
                    prop="max_num.name"
                    label="商品民"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="item_number"
                    label="商品数量"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="total_price"
                    label="商品总价"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="kd_company"
                    label="快递公司"
                    width="300">
            </el-table-column>
            <el-table-column
                    prop="kd_code"
                    label="快递单号"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="new_status"
                    label="状态"
                    width="120">
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="操作"
                    width="260">
                <template scope="scope">
                    <el-button
                            @click.native.prevent="deleteRow(scope.$index,data.data)"
                            type="text"
                            size="small">
                        移除
                    </el-button>
                    <el-button
                            @click.native.prevent="cancelOrder(scope.$index, data.data)"
                            type="text"
                            size="small">
                        取消订单
                    </el-button>
                    <el-popover
                            ref="popover4"
                            placement="right"
                            width="420"
                            trigger="click">
                        <el-table :data="gridData">
                            <el-table-column width="150" property="AcceptTime" label="接受时间"></el-table-column>
                            <el-table-column width="300" property="AcceptStation" label="站点"></el-table-column>
                            <el-table-column width="100" property="Remark" label="备注"></el-table-column>
                        </el-table>
                    </el-popover>

                    <el-button
                            v-popover:popover4
                            @click="getKd(scope.$index, data.data)"
                            type="text"
                            size="small">
                        查看物流
                    </el-button>
                    <el-button
                            @click="payMoney(scope.$index, data.data)"
                            type="text"
                            size="small">
                        付款
                    </el-button>
                    <el-button
                            @click="finish(scope.$index, data.data)"
                            type="text"
                            size="small">
                        收获
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination
                @current-change="handleCurrentChange"
                :current-page="data.current_page"
                layout="total, prev, pager, next, jumper"
                :total="data.total">
        </el-pagination>
        <el-button
                @click="notShowNew"
                type="primary"
        >
            不显示为下单订单
        </el-button>

    </div>
</template>

<script>
    export default {
        methods: {
            getKd(index, rows){
                axios.get('/api/front/getKd/' +
                    this.data.data[index].order_id).then(res => {
                    if (res.data.Success == false) {
                        this.$notify({
                            title: '获取失败',
                            message: res.data.Reason,
                            type: 'error'
                        });
                    } else {
                        this.gridData = res.data.Traces
                    }

                })
            },
            deleteRow(index, rows) {
                this.$confirm('此操作将永久删除该订单, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.delete('/api/user/new_order/' +
                        this.data.data[index].order_id).then(res => {
                        this.$notify({
                            title: '移除成功',
                            message: '订单移除成功',
                            type: 'success'
                        });
                        rows.splice(index, 1);
                    }).catch(err => {
                        this.$notify({
                            title: '移除失败',
                            message: res.data.err_msg,
                            type: 'error'
                        });
                    })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });

            },
            cancelOrder(index, rows){
                this.$confirm('此操作将取消订单, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.put('/api/user/new_order/' +
                        this.data.data[index].order_id + '?status=cancel')
                        .then(res => {
                            if (res.data.code != 0) {
                                this.data = res.data
                                this.$message({
                                    type: 'success',
                                    message: '取消订单成功!'
                                });
                            } else {
                                this.$message({
                                    type: 'error',
                                    message: res.data.err_msg
                                });
                            }

                        })

                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消操作'
                    });
                });
            },
            showKD(index, rows){
                this.$alert('这是一段内容', '标题名称', {
                    confirmButtonText: '确定',
                    callback: action => {
                        this.$message({
                            type: 'info',
                            message: `action: ${ action }`
                        });
                    }
                });
            },
            notShowNew(){
                axios.get('/api/user/new_order', {
                    params: {
                        page: this.data.current_page,
                        page_size: this.data.per_page,
                        not_show_new: true
                    }
                }).then(res => {
                    this.data = res.data
                })
            },
            handleSizeChange(val) {
                axios.get('/api/user/new_order', {
                    params: {
                        page_size: val
                    }
                }).then(res => {
                    this.data = res.data
                })
                console.log(this.data);
            },
            handleCurrentChange(val) {
                axios.get('/api/user/new_order', {
                    params: {
                        page: val,
                        page_size: this.data.per_page
                    }
                }).then(res => {
                    this.data = res.data
                })
                console.log(`当前页: ${val}`);
            },
            payMoney(index, rows) {
                this.$confirm('您将全额支付，是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.put('/api/user/new_order/' +
                        this.data.data[index].order_id + "?status=payed").then(res => {
                        if (res.data.code != 0) {
                            this.data = res.data
                            this.$notify({
                                title: '支付成功',
                                message: '订单支付成功',
                                type: 'success'
                            });
                        } else {
                            this.$notify({
                                title: '支付失败',
                                message: res.data.err_msg,
                                type: 'error'
                            });
                        }
                    }).catch(err => {
                        this.$notify({
                            title: '支付失败',
                            message: res.data.err_msg,
                            type: 'error'
                        });
                    })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消支付'
                    });
                });

            },
            finish(index, rows) {
                if (this.data.data[index].status != 'send') {
                    this.$message({
                        type: 'info',
                        message: '订单未发货或已完成'
                    });
                } else {
                    this.$confirm('您将确认收获完成订单，是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        axios.put('/api/user/new_order/' +
                            this.data.data[index].order_id + "?status=finished").then(res => {
                            if (res.code != 0) {
                                this.data = res.data
                                this.$notify({
                                    title: '收获成功',
                                    message: '订单收获成功',
                                    type: 'success'
                                });
                            } else {
                                this.$notify({
                                    title: '收获失败',
                                    message: res.data.err_msg,
                                    type: 'error'
                                });
                            }
                        }).catch(err => {
                            this.$notify({
                                title: '收获失败',
                                message: res.data.err_msg,
                                type: 'error'
                            });
                        })
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: '已取消收获'
                        });
                    });
                }


            },

        },
        data() {
            return {
                data: [],
                gridData: []
            }
        },
        created(){
            axios.get('/api/user/new_order').then(res => {
                this.data = res.data
            })

        }
    }
</script>
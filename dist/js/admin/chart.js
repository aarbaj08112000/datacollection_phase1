$(document).ready(function(){
  google.charts.load('current', {
                                    'packages': ['bar']
                                });
                                google.charts.setOnLoadCallback(drawStuff);


                                function drawStuff() {
                                    // Sales chart 
                                    var data_sales = new google.visualization.arrayToDataTable([
                                        ['MONTH', 'SALES'],
                                        ['APR', 1230000],
                                        ['MAY', 1180000],
                                        ['JUN', 1245000],
                                        ['JUL', 1080100],
                                        ['AUG', 912100],
                                        ['SEP', 1372500],
                                        ['OCT', 0],
                                        ['NOV', 0],
                                        ['DEC', 0],
                                        ['JAN', 0],
                                        ['FEB', 0],
                                        ['MAR', 0]
                                    ]);
                                       // ['Move', 'Sales Value'],
                                        <?php
                                      /*      for ($i = 1; $i <= 12; $i++) {

                                                $month_data = $this->Common_admin_model->get_month($i);
                                                $month_number = $this->Common_admin_model->get_month_number($month_data);

                                                $main_sum = $this->db->query(
                                                    'SELECT SUM(total_rate) as MAINSUM FROM `sales_parts` WHERE created_month = ' . $month_number . ' AND created_year = ' . $selected_year . ''
                                                );
                                                $main_sum_result = $main_sum->result();
                                                $month_value = 0;
                                                $month_value = $main_sum_result[0]->MAINSUM ? $main_sum_result[0]->MAINSUM : 0;
                                               
                                                echo "['" . $month_data . "'," . $month_value . "],";
                                            }*/
                                            ?>
                                    
                                   var options = {
                                        legend: {
                                            position: 'none'
                                        },
                                        chart: {
                                            title: 'Sales',
                                            // subtitle: 'popularity by percentage'
                                        },
                                        axes: {
                                            x: {
                                                0: {
                                                    side: '',
                                                    label: 'Month'
                                                } // Top x-axis.
                                            }
                                        },
                                        /*bar: {
                                            groupWidth: "80%"
                                        }*/
                                    };

                                    var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                                    
                                    chart.draw(data_sales, google.charts.Bar.convertOptions(options));
                                    
                                    //----------------------------------------------------------------------
                                    // CUSTOMER PPM
                                    var data_customer_ppm = new google.visualization.arrayToDataTable([
                                        ['MONTH', 'PPM'],
                                        ['APR', 5000],
                                        ['MAY', 2580],
                                        ['JUN', 1000],
                                        ['JUL', 3200],
                                        ['AUG', 0],
                                        ['SEP', 1244],
                                        ['OCT', 0],
                                        ['NOV', 0],
                                        ['DEC', 0],
                                        ['JAN', 0],
                                        ['FEB', 0],
                                        ['MAR', 0]
                                    ]);

                                    //var ppm = new google.visualization.arrayToDataTable([
                                      //  ['Move', 'Sales Value'],
                                        <?php
                                        /*
                                        for ($i = 1; $i <= 12; $i++) {
                                            $month_data = $this->Common_admin_model->get_month($i);
                                            $month_number = $this->Common_admin_model->get_month_number($month_data);

                                            $main_sum = $this->db->query(
                                                'SELECT SUM(total_rate) as MAINSUM FROM `sales_parts` WHERE created_month = ' . $month_number . ' AND created_year = ' . $selected_year . ''
                                            );
                                            $main_sum_result = $main_sum->result();
                                            $month_value = 0;
                                            $month_value = $main_sum_result[0]->MAINSUM ? ($main_sum_result[0]->MAINSUM / ( 5 * 10000)) : 0;

                                            /* $month_data = $this->Common_admin_model->get_month($i);
                                            $last_month = $this->Common_admin_model->get_month_number($month_data);

                                            $child_part_list_month = $this->db->query('SELECT SUM(accepted_qty) as rejection_sum FROM `parts_rejection_sales_invoice` WHERE created_month = "'.$last_month.'" AND created_year = 2023  ');
                                         
                                            $rejection_sum_qty_data_month  = $child_part_list_month->result();
                                            
                                            $rejection_qty = 0;
                                            if ($rejection_sum_qty_data_month) {
                                              $rejection_qty = $rejection_sum_qty_data_month[0]->rejection_sum;
                                              
                                            }
                                            $child_part_list_monthsales_sum = $this->db->query('SELECT SUM(qty) as sales_sum FROM `sales_parts` WHERE  created_month = ' . $last_month . ' AND created_year = 2023');
                                            $sales_sum_data  = $child_part_list_monthsales_sum->result();
                                            $sales_sum = 0;
            
                                            if ($sales_sum_data) {
                                                $sales_sum = $sales_sum_data[0]->sales_sum ? $sales_sum_data[0]->sales_sum : 0;
                                            }
                                            else
                                            {
                                                $sales_sum = 0;
            
                                            }
            
                                            if ($sales_sum != 0) {
                                                $last_monnth_ppl = (($rejection_qty / $sales_sum) * 1000000)/1000000;
                                            } else {
                                                $last_monnth_ppl = 0;
                                            }
                                                   
                                                    echo "['" . $month_data . "'," . $month_value . "],";
                                                } */
                                        ?>
                                 

                                   var options2 = {
                                        //width: 600,
                                        legend: {
                                            position: 'none'
                                        },
                                        chart: {
                                            title: 'Customer PPM',
                                            // subtitle: 'popularity by percentage'
                                        },
                                        axes: {
                                            x: {
                                                0: {
                                                    side: '',
                                                    label: 'Month'
                                                } // Top x-axis.
                                            }
                                        },
                                        /*bar: {
                                            groupWidth: "80%"
                                        }*/
                                    };

                                    var chart2 = new google.charts.Bar(document.getElementById('top_x_div2'));
                                    chart2.draw(data_customer_ppm, google.charts.Bar.convertOptions(options2));

                                    //----------------------------------------------------------------------
                                    // PURCHASE GRN
                                    var data_grn = new google.visualization.arrayToDataTable([
                                        ['MONTH', 'GRN'],
                                        ['APR', 132200],
                                        ['MAY', 158789],
                                        ['JUN', 126342],
                                        ['JUL', 132575],
                                        ['AUG', 140220],
                                        ['SEP', 157980],
                                        ['OCT', 0],
                                        ['NOV', 0],
                                        ['DEC', 0],
                                        ['JAN', 0],
                                        ['FEB', 0],
                                        ['MAR', 0]
                                    ]);

                                     //var data3 = new google.visualization.arrayToDataTable([
                                      //  ['Move', 'Sales Value'],
                                        <?php
                                        /*
                                            for ($i = 1; $i <= 12; $i++) {

                                                $month_data = $this->Common_admin_model->get_month($i);
                                                $month_number = $this->Common_admin_model->get_month_number($month_data);

                                                $main_sum = $this->db->query(
                                                    'SELECT SUM(total_rate) as MAINSUM FROM `sales_parts` WHERE created_month = ' . $month_number . ' AND created_year = ' . $selected_year . ''
                                                );
                                                $main_sum_result = $main_sum->result();
                                                $month_value = 0;
                                                $month_value = $main_sum_result[0]->MAINSUM ? $main_sum_result[0]->MAINSUM * 1.2 : 0;
                                                echo "['" . $month_data . "'," . $month_value . "],";
                                            } */
                                            ?>
                                 

                                    var options3 = {
                                        //width: 600,
                                        legend: {
                                            position: 'none'
                                        },
                                        chart: {
                                            title: 'Purchase GRN in Rs.',
                                            // subtitle: 'popularity by percentage'
                                        },
                                        axes: {
                                            x: {
                                                0: {
                                                    side: '',
                                                    label: 'Month'
                                                } // Top x-axis.
                                            }
                                        },
                                        bar: {
                                            groupWidth: "80%"
                                        }
                                    };

                                    var chart3 = new google.charts.Bar(document.getElementById('top_x_div3'));
                                    chart3.draw(data_grn, google.charts.Bar.convertOptions(options3));

                                    //----------------------------------------------------------------------
                                     // PRODUCTION PPM
                                     var data_production_ppm = new google.visualization.arrayToDataTable([
                                        ['MONTH', 'PPM'],
                                        ['APR', 12000],
                                        ['MAY', 4800],
                                        ['JUN', 9876],
                                        ['JUL', 3311],
                                        ['AUG', 1200],
                                        ['SEP', 3400],
                                        ['OCT', 0],
                                        ['NOV', 0],
                                        ['DEC', 0],
                                        ['JAN', 0],
                                        ['FEB', 0],
                                        ['MAR', 0]
                                    ]);

                                    // Other4 chart 
                                   // var data4 = new google.visualization.arrayToDataTable([
                                   //     ['Move', 'Sales Value'],
                                        <?php
                                        /*
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month_data = $this->Common_admin_model->get_month($i);
                                                $month_number = $this->Common_admin_model->get_month_number($month_data);

                                                $main_sum = $this->db->query(
                                                    'SELECT SUM(total_rate) as MAINSUM FROM `sales_parts` WHERE created_month = ' . $month_number . ' AND created_year = ' . $selected_year . ''
                                                );
                                                $main_sum_result = $main_sum->result();
                                                $month_value = 0;
                                                $month_value = $main_sum_result[0]->MAINSUM ? $main_sum_result[0]->MAINSUM * 1.2 : 0;
                                                echo "['" . $month_data . "'," . $month_value . "],";
                                            }
                                        */
                                            ?>
                                   // ]);

                                    var options4 = {
                                       // width: 600,
                                        legend: {
                                            position: 'none'
                                        },
                                        chart: {
                                            title: 'Production PPM',
                                            // subtitle: 'popularity by percentage'
                                        },
                                        axes: {
                                            x: {
                                                0: {
                                                    side: '',
                                                    label: 'Month'
                                                } // Top x-axis.
                                            }
                                        },
                                       /* bar: {
                                            groupWidth: "80%"
                                        }
                                        */
                                    };

                                    var chart4 = new google.charts.Bar(document.getElementById('top_x_div4'));
                                    chart4.draw(data_production_ppm, google.charts.Bar.convertOptions(options4));


                                    //----------------------------------------------------------------------
                                    // PRODUCTION OEE
                                     var data_production_oee = new google.visualization.arrayToDataTable([
                                        ['MONTH', 'OEE'],
                                        ['APR', 90],
                                        ['MAY', 87],
                                        ['JUN', 82],
                                        ['JUL', 99],
                                        ['AUG', 110],
                                        ['SEP', 98],
                                        ['OCT', 0],
                                        ['NOV', 0],
                                        ['DEC', 0],
                                        ['JAN', 0],
                                        ['FEB', 0],
                                        ['MAR', 0]
                                    ]);

                                    // Other5 chart 
                                    //var data5 = new google.visualization.arrayToDataTable([
                                    //    ['Move', 'Sales Value'],
                                        <?php
                                        /*
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month_data = $this->Common_admin_model->get_month($i);
                                                $month_number = $this->Common_admin_model->get_month_number($month_data);

                                                $main_sum = $this->db->query(
                                                    'SELECT SUM(total_rate) as MAINSUM FROM `sales_parts` WHERE created_month = ' . $month_number . ' AND created_year = ' . $selected_year . ''
                                                );
                                                $main_sum_result = $main_sum->result();
                                                $month_value = 0;
                                                $month_value = $main_sum_result[0]->MAINSUM ? $main_sum_result[0]->MAINSUM * 1.2 : 0;
                                                echo "['" . $month_data . "'," . $month_value . "],";
                                            }
                                        */
                                            ?>
                                   // ]);

                                    var options5 = {
                                        //width: 600,
                                        legend: {
                                            position: 'none'
                                        },
                                        chart: {
                                            title: 'Production OEE in %',
                                            // subtitle: 'popularity by percentage'
                                        },
                                        /*axes: {
                                            x: {
                                                0: {
                                                    side: '',
                                                    label: 'Month'
                                                } // Top x-axis.
                                            }
                                        },*/
                                        /* bar: {
                                            groupWidth: "80%"
                                        }*/
                                    };

                                    var chart5 = new google.charts.Bar(document.getElementById('top_x_div5'));
                                    chart5.draw(data_production_oee, google.charts.Bar.convertOptions(options5));


                                    //----------------------------------------------------------------------
                                    // PRODUCTION REJECTION
                                    var data_production_rejection = new google.visualization.arrayToDataTable([
                                        ['MONTH', 'Rejection'],
                                        ['APR', 28000],
                                        ['MAY', 14115],
                                        ['JUN', 39674],
                                        ['JUL', 87600],
                                        ['AUG', 67123],
                                        ['SEP', 12222],
                                        ['OCT', 0],
                                        ['NOV', 0],
                                        ['DEC', 0],
                                        ['JAN', 0],
                                        ['FEB', 0],
                                        ['MAR', 0]
                                    ]);


                                    // Other6 chart 
                                    //var data6 = new google.visualization.arrayToDataTable([
                                    //    ['Move', 'Sales Value'],
                                        <?php
                                        /*
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month_data = $this->Common_admin_model->get_month($i);
                                                $month_number = $this->Common_admin_model->get_month_number($month_data);

                                                $main_sum = $this->db->query(
                                                    'SELECT SUM(total_rate) as MAINSUM FROM `sales_parts` WHERE created_month = ' . $month_number . ' AND created_year = ' . $selected_year . ''
                                                );
                                                $main_sum_result = $main_sum->result();
                                                $month_value = 0;
                                                $month_value = $main_sum_result[0]->MAINSUM ? $main_sum_result[0]->MAINSUM * 1.2 : 0;
                                                echo "['" . $month_data . "'," . $month_value . "],";
                                            }
                                        */
                                            ?>
                                    //]);

                                    var options6 = {
                                        //width: 600,
                                        legend: {
                                            position: 'none'
                                        },
                                        chart: {
                                            title: 'Production Rejection in Rs.',
                                            // subtitle: 'popularity by percentage'
                                        },
                                        axes: {
                                            x: {
                                                0: {
                                                    side: 'Rs.',
                                                    label: 'Month'
                                                } // Top x-axis.
                                            }
                                        },
                                        /* bar: {
                                            groupWidth: "80%"
                                        } */
                                    };

                                    var chart6 = new google.charts.Bar(document.getElementById('top_x_div6'));
                                    chart6.draw(data_production_rejection, google.charts.Bar.convertOptions(options6));

                                };
});
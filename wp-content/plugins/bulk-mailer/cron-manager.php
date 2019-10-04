<?php

        function view_all_crons(){
                
                $cron_jobs_in_db = get_option('cron');
                echo '<pre>';
                print_r($cron_jobs_in_db);
                echo '</pre>';
        }

        function remove_cron(){
                
                }
        function update_cron(){
                function cron_add_minute( $schedules, $campaign_timings ) {
                            $schedules['everyminute'] = array(
	                                'interval' => $campaign_timings,
	                                'display' => __( 'Once Every Minute' )
                        );
                        return $schedules;
                        }       
                 }
                
        function add_cron($campaign_id){
        
                global $wpdb;
             
                $sqli = "SELECT * FROM `{$wpdb->prefix}mailer_campaigns` WHERE `id`='$campaign_id'";
                $id = $campaign_id;
                $row = $wpdb->get_row($sqli);
               
               
                extract((array)$row);
            
                
                if(wp_next_scheduled( 'BM_cron_event_'.$id ) ) {  
                        $timestamp = wp_next_scheduled ('BM_cron_event_'.$id);
	                wp_unschedule_event ($timestamp, 'BM_cron_event_'.$id);
                }
                
                function BM_cron_recurrence_interval($schedules){
                        $schedules['BM_cron_schedule_'.$id] = array(
                                'interval' => $row->campaign_timings,
	                        'display' => __( 'BM_cron_schedule_'.$id )
                        );
                        return $schedules;
                }
                add_filter( 'cron_schedules', 'BM_cron_recurrence_interval' );
                
                wp_schedule_event( time(), 'BM_cron_schedule_'.$id , 'BM_cron_event_'.$id );
                
                function BM_cron_event_(){
                        $recepients = $row->selected_list;
                        $message = $row->selected_template; 
                        mail($recepients,$message); 
                                   
                }
               
                add_action( 'BM_cron_event_'.$id , 'BM_cron_event_' );
                view_all_crons();   
               
        }
?>      

<?php 
$xml = '<?xml version="1.0"?>
			<?qbposxml version="2.0"?>	
			<QBPOSXML>
			<QBPOSXMLMsgsRq onError="continueOnError">
				<SalesOrderAddRq>
					<SalesOrderAdd>
						'.$cust_ident;
						if($WC_Order->get_cart_discount() > 0):
							$xml.='<Discount>' .$WC_Order->get_cart_discount().'</Discount>';
						endif;
						if($WC_Order->get_order_discount() > 0):
							$xml.='<Discount>' .$WC_Order->get_order_discount().'</Discount>';
						endif;
						$xml.='<SalesOrderNumber>'. $WC_Order->get_order_number() .'</SalesOrderNumber>
								<SalesOrderType>SalesOrder</SalesOrderType>
								<TxnDate>'.date("Y-m-d",strtotime($WC_Order->order_date)).'</TxnDate>';
						if(
							isset($WC_Order->shipping_city) || 
							isset($WC_Order->shipping_country) ||
							isset($WC_Order->shipping_last_name) ||
							isset($WC_Order->shipping_first_name) ||
							isset($WC_Order->billing_phone) ||
							isset($WC_Order->shipping_postcode) ||
							isset($WC_Order->order_shipping) ||
							isset($WC_Order->shipping_state) ||
							isset($WC_Order->shipping_address_1) ||
							isset($WC_Order->shipping_address_2)
						):
						$xml.='<ShippingInformation>';
							if(isset($WC_Order->shipping_city)):
								$xml.='<City>'.$WC_Order->shipping_city.'</City>';
							endif;
							if(isset($WC_Order->shipping_company)):
								$xml.='<CompanyName>'.$WC_Order->shipping_company.'</CompanyName>';
							endif;
							if(isset($WC_Order->shipping_country)):
								$xml.='<Country>'.$WC_Order->shipping_country.'</Country>';
							endif;
							if(isset($WC_Order->shipping_last_name) && isset($WC_Order->shipping_first_name)):
								$xml.='<FullName>'.$WC_Order->shipping_last_name.', '.$WC_Order->shipping_first_name.'</FullName>';
							endif;
							if(isset($WC_Order->billing_phone)):
								$xml.='<Phone>'.$WC_Order->billing_phone.'</Phone>';
							endif;
							if(isset($WC_Order->shipping_postcode)):
								$xml.='<PostalCode>'.$WC_Order->shipping_postcode.'</PostalCode>';
							endif;
							if(isset($WC_Order->order_shipping) && $WC_Order->order_shipping > 0 ):
								$xml.='<Shipping>'.$WC_Order->order_shipping.'</Shipping>';
							endif;
							if(isset($WC_Order->shipping_state)):
								$xml.='<State>'.$WC_Order->shipping_state.'</State>';
							endif;
							if(isset($WC_Order->shipping_address_1)):
								$xml.='<Street>'.$WC_Order->shipping_address_1.'</Street>';
							endif;
							if(isset($WC_Order->shipping_address_2) && $WC_Order->shipping_address_2 !=''):
								$xml .='<Street2>'.$WC_Order->shipping_address_2.'</Street2>';
							endif;
							$xml.='
						</ShippingInformation>';
						endif;
						$xml.= $line_items .
						'</SalesOrderAdd>
				</SalesOrderAddRq>
			</QBPOSXMLMsgsRq>
		</QBPOSXML>';
return $xml;
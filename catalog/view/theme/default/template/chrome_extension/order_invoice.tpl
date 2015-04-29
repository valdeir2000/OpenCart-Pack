<html>
	<head>
		<title>Invoice</title>
		<style type="text/css">
			* {margin: 0;padding: 0}
			html, body {height:100%}
			body {background:#000}
		</style>
	</head>
	
	<body>
		<div style="background:#000;height:100%" id="content">
			<table cellspacing="0">
				<tr>
					<td style="width:900px;background:#000;font-family:arial;height:100%" valign="top">
						
						<!-- Header -->
						<table style="width:705px;background:#FFF;margin:35px 32px 0 32px;position: relative;padding-right: 15px;height:80%" cellspacing="0">
							<tr>
								<td>
									
									<div style="margin-top:10px"></div>
									
									<table cellspacing="0" height="50px" width="100%">
										<tr>
											<td style="background:#F00;color:#FFF;padding:0px 30px;text-align:center;width:30%;float:left;">
												<h3 style="top:10px;padding:0;height:50px;position:relative;"><?php echo $store_name ?></h3>
											</td>
											<td style="color:#727272;padding-right:10px;width:70%;" align="right">
												<h2 style="margin:0;padding:0;">Invoice <?php echo $invoice ?></h2>
												<h6 style="margin:0;padding:0;">Date: <?php echo $date_added ?></h6>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							
							<!-- Dados da Loja e Comprador -->
							<tr>
								<td>
									<div style="margin-top:80px"></div>
									<table style="width:100%;" cellspacing="0">
										<tr>
											<td style="width:33%;float:left;color:#727272;padding-left:30px;vertical-align:top;">
												<h3 style="margin:0px;padding:0;">From:</h3><br/>
												<span><?php echo $store_name ?></span><br/>
												<?php echo $store_address ?>
											</td>
											
											<td style="width:33%;float:left;color:#727272;vertical-align:top;">
												<h3 style="margin:0;padding:0">Payment:</h3><br/>
												<span><?php echo $payment_firstname . ' ' . $payment_lastname ?></span><br/>
												<span><?php echo $payment_address_1 ?></span><br/>
												<span><?php echo $payment_address_2 ?></span><br/>
												<span><?php echo $payment_city . ' - ' . $payment_zone ?></span><br/>
												<span><?php echo $payment_country ?></span><br/>
												<span><?php echo $payment_postcode ?></span>
											</td>
											
											<td style="width:33%;float:left;color:#727272;vertical-align:top;">
												<h3 style="margin:0;padding:0">Shipping:</h3><br/>
												<span><?php echo $shipping_firstname . ' ' . $shipping_lastname ?></span><br/>
												<span><?php echo $shipping_address_1 ?></span><br/>
												<span><?php echo $shipping_address_2 ?></span><br/>
												<span><?php echo $shipping_city . ' - ' . $shipping_zone ?></span><br/>
												<span><?php echo $shipping_country ?></span><br/>
												<span><?php echo $shipping_postcode ?></span>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							
							<!-- Produtos -->
							<tr>
								<td>
									<div style="margin-top:80px"></div>
									<table cellspacing="0" style="width:650px;">
										<thead>
											<tr style="text-transform:uppercase;font-size:80%;font-weight:bold;color:#FFF;background: #424242;">
												<td style="width: 30%;padding-left:30px;border-right:1px solid #5e5e5e;height:83px;" valign="middle">Product</td>
												<td style="width: 30%;padding-left:30px;border-right:1px solid #5e5e5e;height:83px;" valign="middle">Model</td>
												<td style="padding:0 10px;border-right:1px solid #5e5e5e;height:83px;" valign="middle">Quantity</td>
												<td style="width: 12%;text-align:center;border-right:1px solid #5e5e5e;height:83px;" valign="middle">Unit Price</td>
												<td style="width: 25%;text-align:right;padding-right:30px;height:83px;" valign="middle">Total</td>
											</tr>
										</thead>
										
										<tbody style="font-size:100%;">
											<?php foreach($products as $key => $product): ?>
											<tr style="<?php echo ($key % 2 == 1) ? 'background:#FAFAFA' : '' ?>">
												<td style="vertical-align:middle;width: 30%;height:40px;padding-left:30px;border-right:1px solid #efefef;border-bottom:1px solid #efefef;"><?php echo $product['name'] ?></td>
												<td style="vertical-align:middle;width: 30%;height:40px;padding-left:30px;border-right:1px solid #efefef;border-bottom:1px solid #efefef"><?php echo $product['model'] ?></td>
												<td style="vertical-align:middle;height:40px;text-align:center;border-right:1px solid #efefef;border-bottom:1px solid #efefef"><?php echo $product['quantity'] ?></td>
												<td style="vertical-align:middle;width: 12%;height:40px;padding:0 10px;text-align:center;border-right:1px solid #efefef;border-bottom:1px solid #efefef"><?php echo $product['price'] ?></td>
												<td style="vertical-align:middle;width: 25%;height:40px;padding-right:30px;border-right:1px solid #efefef;text-align:right;border-bottom:1px solid #efefef"><?php echo $product['total'] ?></td>
											</tr>
											<?php endforeach ?>
										</tbody>
										
										<tfoot style="font-weight:bold;">
											<?php foreach($totals as $total): ?>
											<tr>
												<td style="vertical-align:middle;height:40px;padding:0 10px;text-align:center;border-right:1px solid #efefef;text-align:right;border-bottom:1px solid #efefef" colspan="4"><?php echo $total['title'] ?>:</td>
												<td style="vertical-align:middle;height:40px;padding-right:30px;border-right:1px solid #efefef;text-align:right;border-bottom:1px solid #efefef"><?php echo $total['value'] ?></td>
											</tr>
											<?php endforeach ?>
										</tfoot>
									</table>
								</td>
							</tr>

							<!-- Comentários da Compra -->
							<tr>
								<td>
									<div style="margin-top:80px;font-size:80%;margin-left:30px;margin-bottom:50px">
										<?php if ($comment): ?>
										<b style="color:#7e7e7e">Additional Notes</b>
										<p style="color:#7e7e7e;margin-top:5px"><?php echo $comment ?></p>
										<?php endif ?>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			
			<div style="height:70px"></div>
		</div>
	</body>
</html>
<?php echo $header; ?>
<div id="content">
	<div class="box">
		<div class="heading">
			<h1>Correios</h1>
			<div class="buttons">
				<a onclick="$('#form').submit();" class="button"><span>Salvar</span></a>
				<a onclick="index.php?route=step_4" class="button"><span>Cancelar</span></a>
			</div>
		</div>
		<div class="content">
			<form action="index.php?route=step_4/configure&next=true" method="post" enctype="multipart/form-data" id="form">
				<table class="form">
					<tr>
						<td><span class="required">*</span> CEP de origem:<br />
						</td>
						<td><input name="correios_postcode" type="text" id="correios_postcode" />
						</td>
					</tr>
					<tr>
						<td>
							Serviços:
							<span class="help">Habilite os serviços que deseja usar em sua loja.</span>
						</td>
						<td>
							<div class="scrollbox">
								<div class="odd">
									<input type="checkbox" name="correios_40010" value="1" />
									SEDEX - sem contrato
								</div>
								<div class="even">
									<input type="checkbox" name="correios_40045" value="1" />
									SEDEX a Cobrar - sem contrato
								</div>
								<div class="odd">
									<input type="checkbox" name="correios_40126" value="1" />
									SEDEX a Cobrar - com contrato
								</div>
								<div class="even">
									<input type="checkbox" name="correios_40215" value="1" />
									SEDEX 10 - sem contrato
								</div>
								<div class="odd">
									<input type="checkbox" name="correios_40290" value="1" />
									SEDEX Hoje - sem contrato
								</div>
								<div class="even">
									<input type="checkbox" name="correios_40096" value="1" />
									SEDEX - com contrato (40096)
								</div>
								<div class="odd">
									<input type="checkbox" name="correios_40436" value="1" />
									SEDEX - com contrato (40436)
								</div>
								<div class="even">
									<input type="checkbox" name="correios_40444" value="1" />
									SEDEX - com contrato (40444)
								</div>
								<div class="odd">
									<input type="checkbox" name="correios_40568" value="1" />
									SEDEX - com contrato (40568)
								</div>
								<div class="even">
									<input type="checkbox" name="correios_40606" value="1" />
									SEDEX - com contrato (40606)
								</div>
								<div class="odd">
									<input type="checkbox" name="correios_41106" value="1" />
									PAC - sem contrato
								</div>
								<div class="even">
									<input type="checkbox" name="correios_41068" value="1" />
									PAC - com contrato
								</div>
								<div class="odd">
									<input type="checkbox" name="correios_81019" value="1" />
									e-SEDEX - com contrato
								</div>
								<div class="even">
									<input type="checkbox" name="correios_81027" value="1" />
									e-SEDEX Prioritário - com contrato
								</div>
								<div class="odd">
									<input type="checkbox" name="correios_81035" value="1" />
									e-SEDEX Express - com contrato
								</div>
								<div class="even">
									<input type="checkbox" name="correios_81868" value="1" />
									(Grupo 1) e-SEDEX - com contrato
								</div>
								<div class="odd">
									<input type="checkbox" name="correios_81833" value="1" />
									(Grupo 2) e-SEDEX - com contrato
								</div>
								<div class="even">
									<input type="checkbox" name="correios_81850" value="1" />
									(Grupo 3) e-SEDEX - com contrato
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							Contrato com os Correios:
							<span class="help">Código administrativo e a senha para acesso aos serviços com contrato.</span>
						<br />
						</td>
						<td>
							Código:<br /><input name="correios_contrato_codigo" type="text" id="correios_contrato_codigo" /><br/>
							Senha:<br /><input name="correios_contrato_senha" type="text" id="correios_contrato_senha" />
						</td>
					</tr>
					<tr>
						<td>
							Mão própria:
							<span class="help">É o serviço opcional pelo qual o remetente recebe a garantia de que o objeto, por ele postado sob registro, será entregue somente ao próprio destinatário, através da confirmação de sua identidade.</span>
						</td>
						<td>
							<select name="correios_mao_propria">
								<option value="n">Não</option>
								<option value="s">Sim</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Aviso de recebimento:
							<span class="help">É o serviço adicional que, através do preenchimento de formulário próprio, físico ou digital, permite comprovar, junto ao remetente, a entrega do objeto.</span>
						</td>
						<td>
							<select name="correios_aviso_recebimento">
								<option value="n">Não</option>
								<option value="s">Sim</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Declarar valor:<br />
						</td>
						<td>
							<select name="correios_declarar_valor">
								<option value="n">Não</option>
								<option value="s">Sim</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Valor adicional (%):<br />
						</td>
						<td><input name="correios_adicional" type="text" id="correios_adicional" />
						</td>
					</tr>
					<tr>
						<td>Prazo de entrega adicional (em dias):<br />
						</td>
						<td><input name="correios_prazo_adicional" type="text" id="correios_prazo_adicional" />
						</td>
					</tr>
					<tr>
						<td>Grupo de Impostos:</td>
						<td>
							<select name="correios_tax_class_id">
								<option value="0">-- Vazio --</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Região Geográfica:</td>
						<td>
							<select name="correios_geo_zone_id">
								<option value="0">Todas as regiões</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="25%">Situação:</td>
						<td>
							<select name="correios_status">
								<option value="1">Habilitar</option>
								<option value="0">Desabilitar</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Ordem:</td>
						<td><input type="text" name="correios_sort_order" size="1" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php echo $footer; ?>

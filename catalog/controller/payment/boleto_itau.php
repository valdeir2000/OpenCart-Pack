<?php
class ControllerPaymentBoletoitau extends Controller {
	public function index() {

        $this->language->load('payment/boleto_itau');

        $data['text_instruction'] = $this->language->get('text_instruction');
        $data['text_instruction2'] = $this->language->get('text_instruction2');
        $data['text_bank'] = $this->language->get('text_bank');
        $data['text_payment'] = $this->language->get('text_payment');
        $data['text_linkboleto'] = $this->language->get('text_linkboleto');
        $data['text_linkboleto2'] = $this->language->get('text_linkboleto2');

        $data['button_continue'] = $this->language->get('button_continue');
        $data['button_back'] = $this->language->get('button_back');

        $this->load->library('encryption');

        $encryption = new Encryption($this->config->get('config_encryption'));

        $data['idboleto'] = $encryption->encrypt($this->session->data['order_id']);

        $data['back'] = $this->url->link('checkout/checkout', '', 'SSL');

        $data['button_confirm'] = $this->language->get('button_confirm');

        $data['continue'] = $this->url->link('checkout/success');

        $this->id = 'payment';

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/boleto_itau.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/payment/boleto_itau.tpl', $data);
        } else {
            return $this->load->view('default/template/payment/boleto_itau.tpl', $data);
        }

        $this->render();

		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['continue'] = $this->url->link('checkout/success');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/boleto_itau.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/boleto_itau.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/boleto_itau.tpl', $data);
		}
	}

	public function confirm() {
        $this->load->library('encryption');

        $encryption = new Encryption($this->config->get('config_encryption'));
        $order_id = $encryption->encrypt($this->session->data['order_id']);

        $this->load->language('payment/boleto_itau');

        $this->load->model('checkout/order');

        $codigo_boleto = $order_id;

        $comment  = $this->language->get('text_instruction') . "\n\n";
        $comment .= sprintf($this->language->get('text_linkboleto'), $codigo_boleto). "\n\n";
        $comment .= $this->language->get('text_payment');

		if ($this->session->data['payment_method']['code'] == 'boleto_itau') {
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('boleto_itau_order_status_id'));
		}
	}

    public function callback() {
        $this->load->library('encryption');

        $encryption = new Encryption($this->config->get('config_encryption'));
        $order_id = $encryption->decrypt(@$this->request->get['order_id']);

        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($order_id);

        if($order_info){

            //############################## inicio configuração do boleto #################////
            // DADOS DO BOLETO PARA O SEU CLIENTE
            $dias_de_prazo_para_pagamento = $this->config->get('boleto_itau_dia_prazo_pg');
            $taxa_boleto =$this->config->get('boleto_itau_taxa_boleto');
            $data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
            $valor_cobrado = $order_info['total']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
            $valor_cobrado = str_replace(",", ".",$valor_cobrado);
            $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

            $dadosboleto["nosso_numero"] = str_pad($order_info['order_id'], 8, "0", STR_PAD_LEFT); //$this->config->get('boleto_itau_nosso_numero');
            $dadosboleto["numero_documento"] = str_pad($order_info['order_id'], 8, "0", STR_PAD_LEFT);  // Num do pedido ou do documento
            $dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
            $dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
            $dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
            $dadosboleto["valor_boleto"] = $valor_boleto;   // Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

            // DADOS DO SEU CLIENTE
            $dadosboleto["sacado"] = $order_info['payment_firstname']." ".$order_info['payment_lastname'];
            $dadosboleto["endereco1"] = $order_info['payment_address_1']." ".$order_info['payment_address_2'];
            $dadosboleto["endereco2"] = $order_info['payment_city']."-".$order_info['payment_zone']."- CEP:".$order_info['payment_postcode'];

            // INFORMACOES PARA O CLIENTE
            if (!empty($taxa_boleto)) {
                $taxa = "<br>Taxa banc&aacute;ria - R$ ".number_format($taxa_boleto, 2, ',', '');
            }else{
                $taxa = "";
            }

            $dadosboleto["demonstrativo1"] = $this->config->get('boleto_itau_demonstrativo1').$taxa;
            $dadosboleto["demonstrativo2"] = $this->config->get('boleto_itau_demonstrativo2');
            $dadosboleto["demonstrativo3"] = $this->config->get('boleto_itau_demonstrativo3');

            // INSTRUÇÕES PARA O CAIXA
            $dadosboleto["instrucoes1"] = $this->config->get('boleto_itau_instrucoes1');
            $dadosboleto["instrucoes2"] = $this->config->get('boleto_itau_instrucoes2');
            $dadosboleto["instrucoes3"] = $this->config->get('boleto_itau_instrucoes3');
            $dadosboleto["instrucoes4"] = $this->config->get('boleto_itau_instrucoes4');

            // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
            $dadosboleto["quantidade"] = "";
            $dadosboleto["valor_unitario"] = "";
            $dadosboleto["aceite"] = $this->config->get('boleto_itau_aceite');;
            $dadosboleto["especie"] = "R$";
            $dadosboleto["especie_doc"] = "";

            // ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //

            // DADOS DA SUA CONTA - BANCO ITAÚ
            $converte_conta = explode("-",$this->config->get('boleto_itau_conta'));
            $dadosboleto["agencia"] =$this->config->get('boleto_itau_agencia'); // Num da agencia, sem digito
            $dadosboleto["conta"] = $converte_conta[0];     // Num da conta, sem digito
            $dadosboleto["conta_dv"] = "";         // Digito do Num da conta


            // DADOS PERSONALIZADOS - BANCO ITAÚ
            $dadosboleto["convenio"] = $this->config->get('boleto_itau_convenio');  // Num do convênio - REGRA: 6 ou 7 ou 8 dígitos
            $dadosboleto["contrato"] = $this->config->get('boleto_itau_contrato'); // Num do seu contrato
            $dadosboleto["carteira"] = $this->config->get('boleto_itau_carteira');
            $dadosboleto["variacao_carteira"] = $this->config->get('boleto_itau_variacao_carteira');  // Variação da Carteira, com traço (opcional)

            // TIPO DO BOLETO
            $dadosboleto["formatacao_convenio"] = $this->config->get('boleto_itau_formatacao_convenio'); // REGRA: 8 p/ Convênio c/ 8 dígitos, 7 p/ Convênio c/ 7 dígitos, ou 6 se Convênio c/ 6 dígitos
            $dadosboleto["formatacao_nosso_numero"] = $this->config->get('boleto_itau_formatacao_nosso_numero'); // REGRA: Usado apenas p/ Convênio c/ 6 dígitos: informe 1 se for NossoNúmero de até 5 dígitos ou 2 para opção de até 17 dígitos

            /*
            #################################################
            DESENVOLVIDO PARA CARTEIRA 18

            - Carteira 18 com Convenio de 8 digitos
              Nosso número: pode ser até 9 dígitos

            - Carteira 18 com Convenio de 7 digitos
              Nosso número: pode ser até 10 dígitos

            - Carteira 18 com Convenio de 6 digitos
              Nosso número:
              de 1 a 99999 para opção de até 5 dígitos
              de 1 a 99999999999999999 para opção de até 17 dígitos

            #################################################
            */

            // SEUS DADOS
            $dadosboleto["identificacao"] = $this->config->get('boleto_itau_identificacao');
            $dadosboleto["cpf_cnpj"] = $this->config->get('boleto_itau_cpf_cnpj');
            $dadosboleto["endereco"] = $this->config->get('boleto_itau_endereco');
            $dadosboleto["cidade_uf"] = $this->config->get('boleto_itau_cidade_uf');
            $dadosboleto["cedente"] = $this->config->get('boleto_itau_cedente');
            $dadosboleto["empresa_logo"] = $this->config->get('boleto_itau_logo');

            // NÃO ALTERAR!
            ob_start();
            include("boleto/include/funcoes_itau.php");
            $output = include("boleto/include/layout_itau.php");

            //########################FIM CONFIGURAÇÃO DO BOLETO ################################//
        }else{
            //ERRO AO GERAR BOLETO
            $output = "<script>alert(\"Atencao!\\n \\nBoleto bancario nao encontrado!\\n \\nEntre em contato com nosso atendimento.\\n \\nVocê sera redirecionado para a Central do Cliente.\");window.location = 'index.php?route=information/contact';</script>";

        }

        //$this->response->setOutput($output);
    }


}


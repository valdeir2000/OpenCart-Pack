<?php
// Button
$_['button_backup']        = 'Backup';
$_['button_cancel']        = 'Cancelar';
$_['button_clear']         = 'Limpar';
$_['button_download_log']  = 'Download Log';
$_['button_vqcache_dump']  = 'vqcache Dump';

// Heading
$_['heading_title']        = 'VQMod Manager';

// Columns
$_['column_action']        = 'Instalar / Desinstalar';
$_['column_author']        = 'Autor';
$_['column_delete']        = 'Deletar';
$_['column_file_name']     = 'Nome do Arquivo';
$_['column_id']            = 'Nome / Descrição';
$_['column_status']        = 'Status';
$_['column_version']       = 'Versão';
$_['column_vqmver']        = 'Versão do VQMod';

// Entry
$_['entry_author']         = 'Autor:'; // Change
$_['entry_backup']         = 'Backup:';
$_['entry_ext_store']      = 'Última Versão:';
$_['entry_ext_version']    = 'VQMod Manager Versão:';
$_['entry_forum']          = 'OpenCart Forum Thread:';
$_['entry_license']        = 'Licença:';
$_['entry_upload']         = 'Enviar VQMod:';
$_['entry_vqcache']        = 'Cache VQMod:';
$_['entry_vqmod_path']     = 'Caminho VQMod:';
$_['entry_website']        = 'Website:';

// Text Highlighting
$_['highlight']            = '<span class="highlight">%s</span>';

// VQMod Manager Use Errors
$_['error_delete']         = 'Atenção: Não é possível excluir o script VQMod!!';
$_['error_filetype']       = 'Atenção: Extensão inválida, favor só enviar arquivos .xml';
$_['error_install']        = 'Atenção: Não é possível instalar o script VQMod!';
$_['error_invalid_xml']    = 'Atenção: Sintaxe do script xml é inválida. Por favor, entre em contato com o autor para suporte.';
$_['error_log_size']       = 'Atenção: Seu log de erro é %sMBs.  O limite para o "VQMod Manager" é de 6MB.  Você pode baixar o log de erro via FTP ou clicando no "Baixar Log" no botão da guia Log de erro. Caso contrário, considerar limpá-lo.';
$_['error_log_download']   = 'Atenção: Não há logs de erro disponível para download';
$_['error_moddedfile']     = 'Atenção: O script VQMod \'%s\' parece não existir!';
$_['error_move']           = 'Atenção: Não foi possível salvar o arquivo no servidor. Por favor, verifique as permissões do diretório.';
$_['error_permission']     = 'Atenção: Você não tem permissão para modificar o módulo VQMod Manager.';
$_['error_uninstall']      = 'Atenção: Não é possível desinstalar o script VQMod!';
$_['error_vqmod_opencart'] = 'Atenção: O arquivo \'vqmod_opencart.xml\' é necessário para funcionar corretamente!';

// $_FILE Upload Errors
$_['error_form_max_file_size']   = 'Atenção: Script VQMod excede o tamanho máximo permitido!';
$_['error_ini_max_file_size']    = 'Atenção: Script VQMod excede o tamanho máximo do arquivo php.ini!';
$_['error_no_temp_dir']          = 'Atenção: Diretório temporário não encontrado';
$_['error_no_upload']            = 'Atenção: Nenhum arquivo foi selecionado para o upload';
$_['error_partial_upload']       = 'Atenção: Upload imcompleto!';
$_['error_php_conflict']         = 'Atenção: Conflito PHP desconhecido!';
$_['error_unknown']              = 'Atenção: Erro desconhecido!';
$_['error_write_fail']           = 'Atenção: Falha ao escrever script VQMod';

// VQMod Installation Errors
$_['error_error_log_write']            = 'Não foi possível escrever um log de erro!  Por favor, defina a permissão do diretório "<span class="error-install">/vqmod</span>" para 755 ou 777 e tente novamente.';
$_['error_error_logs_write']           = 'Não foi possível escrever um log de erro!  Por favor, defina a permissão do diretório "<span class="error-install">/vqmod/logs</span>" para 755 ou 777 e tente novamente.';
$_['error_opencart_version']           = 'OpenCart 1.5.x ou superior é necessário para utilizar o VQMod Manager!';
$_['error_opencart_xml']               = 'O arquivo "<span class="error-install">/vqmod/xml/vqmod_opencart.xml</span>" parece não existir!  Por favor, instale a última versão do OpenCart compatível com a versão do VQMod em <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> e tente novamente.';
$_['error_opencart_xml_disabled']      = 'Atenção: "<span class="error-install">vqmod_opencart.xml</span>" está desabilitado!  Os scripts VQMod não irão funcionar!';
$_['error_opencart_xml_version']       = 'Você parece estar usando uma versão do "<span class="error-install">vqmod_opencart.xml</span>" que está fora de prazo para a sua versão OpenCart!  Por favor, instale a última versão do OpenCart compatível com a versão do VQMod em <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> e tente novamente.';
$_['error_vqcache_dir']                = 'O diretório "<span class="error-install">/vqmod/vqcache</span>" parece nãoe existir!  Por favor, instale a última versão do OpenCart compatível com a versão do VQMod em VQMod from <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> e tente novamente.';
$_['error_vqcache_write']              = 'Não é possível gravar no diretório "<span class="error-install">/vqmod/vqcache</span>"!  Defina as permissões para 755 ou 777 e tente novamente.';
$_['error_vqcache_files_missing']      = 'VQMod parece não estar gerando adequadamente os arquivos de cache.';
$_['error_vqmod_core']                 = 'O arquivo "<span class="error-install">vqmod.php</span>" parece não existir!  Por favor, instale a última versão do OpenCart compatível com a versão do VQMod em VQMod from <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> e tente novamente.';
$_['error_vqmod_dir']                  = 'O diretório "<span class="error-install">/vqmod</span>" parece não existir!';
$_['error_vqmod_install_link']         = 'O VQMod não parecem ter sido integrado com OpenCart!  Por favor, execute o instalador do VQMod <a href="%1$s">%1$s</a>.';
$_['error_vqmod_opencart_integration'] = 'O VQMod não parecem ter sido integrado com OpenCart!  Por favor, instale a última versão do OpenCart compatível com a versão do VQMod em VQMod from <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> e tente novamente.';
$_['error_vqmod_script_dir']           = 'O diretório "<span class="error-install">/vqmod/xml</span>" parce não existir!  Por favor, instale a última versão do OpenCart compatível com a versão do VQMod em VQMod from <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> e tente novamente.';
$_['error_vqmod_script_write']         = 'Não foi possível gravar no diretório "<span class="error-install">/vqmod/xml</span>"!  Por favor, defina a permissão do diretório para 755 ou 777 e tente novamente';

// VQMod Manager Dependency Errors
$_['error_simplexml']       = '<a href="http://php.net/manual/en/book.simplexml.php" target="_blank">SimpleXML</a> deve ser instalado para o VQMod Manager funcionar correctamente!  Contate o suporte de sua hospedagem para mais informações.';
$_['error_ziparchive']      = '<a href="http://php.net/manual/en/class.ziparchive.php" target="_blank">ZipArchive</a> deve ser instalado para o VQMod Manager funcionar correctamente!  Contate o suporte de sua hospedagem para mais informações';

// VQMod Log Errors
$_['error_mod_aborted']     = 'Mod Abortado';
$_['error_mod_skipped']     = '"Operação Pulada"';

// VQMod Variable Settings
$_['setting_cachetime']       = 'cacheTime:<br /><span class="help">Depreciado no VQMod 2.2.0</span>';
$_['setting_dir_separator']   = 'Seprador do Diretório:';
$_['setting_logfolder']       = 'Pasta de log:<br /><span class="help">VQMod 2.2.0 e superior</span>';
$_['setting_logging']         = 'Logs de Erros:';
$_['setting_modcache']        = 'modCache:';
$_['setting_path_replaces']   = 'Caminho das Substituições :<br /><span class="help">As alterações não entrarão em vigor até que o arquivo mods.cache seja excluído.</span>';
$_['setting_protected_files'] = 'Arquivos Protegidos:';
$_['setting_usecache']        = 'useCache:<br /><span class="help">Depreciado no VQMod 2.1.7</span>';

// Sucesso
$_['Sucesso_clear_vqcache'] = 'Sucesso: VQMod cache limpo!';
$_['Sucesso_clear_log']     = 'Sucesso: VQMod error log limpo!';
$_['Sucesso_delete']        = 'Sucesso: VQMod script deletado!';
$_['Sucesso_install']       = 'Sucesso: VQMod script instalado!';
$_['Sucesso_uninstall']     = 'Sucesso: VQMod script desinstalado!';
$_['Sucesso_upload']        = 'Sucesso: VQMod script enviado!';

// Tabs
$_['tab_about']             = 'Sobre';
$_['tab_error_log']         = 'Log de Erros';
$_['tab_settings']          = 'Configurações e Manutenções';
$_['tab_scripts']           = 'Scripts VQMod';

// Text
$_['text_autodetect']       = 'VQMod parece estar instalado no seguinte caminho. Pressione Salvar para confirmar caminho da instalação.';
$_['text_autodetect_fail']  = 'Não foi possível detectar a instalação VQMod.  Por favor, faça o download em <a href="http://code.google.com/p/vqmod/downloads/list" target="_blank">latest version</a> e instale ou digite o caminho da instalação.';
$_['text_cachetime']        = '%s segundos';
$_['text_delete']           = 'Deletar';
$_['text_disabled']         = 'Desabilitar';
$_['text_enabled']          = 'Habilitar';
$_['text_install']          = 'Instalar';
$_['text_module']           = 'Módulos';
$_['text_no_results']       = 'Scripts VQMod não foram encontrados';
$_['text_separator']        = ' &rarr; ';
$_['text_Sucesso']          = 'Sucesso: Você modificou o módulo VQMod Manager!';
$_['text_unavailable']      = '&mdash;';
$_['text_uninstall']        = 'Desinstalar';
$_['text_upload']           = 'Enviar';
$_['text_usecache_help']    = 'useCache foi depreciado a parti da versão VQMod 2.1.7'; // @TODO
$_['text_vqcache_help']     = 'Limpe o conteúdo do diretório vqcache e delete os arquivos mods.cache.  Alguns arquivos de sistema estará sempre presente, mesmo depois de limpar o cache.';

// Version
$_['vqmod_manager_author']  = 'rph';
$_['vqmod_manager_license'] = 'Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0)';
$_['vqmod_manager_version'] = '2.0';

// Javascript Atençãos
$_['Atenção_required_delete']    = 'Atenção: Deletando o arquivo \\\'vqmod_opencart.xml\\\' o VQMod irá PARAR DE FUNCIONAR!  Deseja Continar?';
$_['Atenção_required_uninstall'] = 'Atenção: Desinstalando o arquivo \\\'vqmod_opencart.xml\\\' o VQMod irá PARAR DE FUNCIONAR!  Deseja Continar?';
$_['Atenção_vqmod_delete']       = 'Atenção: Excluindo um script do VQMod a ação não poderá ser desfeita! Tem certeza de que quer fazer isto?';
?>
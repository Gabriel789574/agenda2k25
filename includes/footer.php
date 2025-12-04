<footer class="main-footer">
    <strong>Copyright &copy; 2025 - Todos os direitos reservados para o Felipe.</strong>
    <div class="float-right d-none d-sm-inline-block">
        <b>AG Versão</b> 2.0
    </div>
</footer>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- ========== DEPENDÊNCIAS PRINCIPAIS ========== -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>$.widget.bridge('uibutton', $.ui.button)</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- ========== PLUGINS DE GRÁFICOS E VISUALIZAÇÃO ========== -->
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>

<!-- ========== PLUGINS DE MAPA ========== -->
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<!-- ========== PLUGINS DE DATA E HORA ========== -->
<!-- Moment.js -->
<script src="../plugins/moment/moment.min.js"></script>
<!-- Date Range Picker -->
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- ========== PLUGINS DE EDITOR E UI ========== -->
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- Overlay Scrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- ========== ADMINLTE ========== -->
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE Dashboard Demo -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE Demo -->
<script src="../dist/js/demo.js"></script>

<!-- ========== DATATABLES ========== -->
<!-- DataTables Core -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<!-- DataTables CDN -->
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.dataTables.js"></script>

<!-- ========== DATATABLES BUTTONS DEPENDENCIAS ========== -->
<!-- JSZip -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<!-- PDFMake -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.print.min.js"></script>

<!-- ========== SCRIPTS DE INICIALIZAÇÃO ========== -->
<script>
    // Configuração DataTable com botões
    document.addEventListener('DOMContentLoaded', function() {
        // Configuração para tabela com ID 'example'
        if (document.querySelector('#example')) {
            new DataTable('#example', {
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    }
                }
            });
        }
        
        // Configuração para tabelas do AdminLTE
        $(function () {
            // Tabela 1 - Responsiva
            if ($("#example1").length) {
                $("#example1").DataTable({
                    "responsive": true,
                    "autoWidth": false,
                });
            }
            
            // Tabela 2 - Configuração personalizada
            if ($('#example2').length) {
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            }
        });
    });
</script>

<style>
/* ========== SCROLL SUAVE COM CSS ========== */

/* 1. ATIVAR SCROLL SUAVE NO HTML (funciona em navegadores modernos) */
@media (prefers-reduced-motion: no-preference) {
    html {
        scroll-behavior: smooth !important;
    }
}

/* 2. ESTILOS PARA ÂNCORAS/VISUALIZAÇÃO */
a[href^="#"] {
    transition: all 0.3s ease !important;
    position: relative !important;
}

/* 3. INDICADOR VISUAL PARA ÂNCORAS */
a[href^="#"]:not([href="#"])::after {
    content: " ↕";
    font-size: 0.8em;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

a[href^="#"]:not([href="#"]):hover::after {
    opacity: 1;
    animation: bounce 1s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

/* 4. DESTAQUE AO CHEGAR NA SEÇÃO ALVO */
:target {
    animation: highlight 2s ease !important;
}

@keyframes highlight {
    0% { background-color: rgba(66, 153, 225, 0) !important; }
    20% { background-color: rgba(66, 153, 225, 0.2) !important; }
    100% { background-color: rgba(66, 153, 225, 0) !important; }
}

/* 5. BOTÃO "VOLTAR AO TOPO" (opcional - só aparece se necessário) */
.scroll-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%) !important;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease;
    z-index: 1000;
    box-shadow: 0 4px 15px rgba(66, 153, 225, 0.3);
    border: none;
}

.scroll-to-top.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.scroll-to-top:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(66, 153, 225, 0.4);
}

/* 6. SCROLLBAR PERSONALIZADA (melhora experiência) */
html {
    scrollbar-width: thin;
    scrollbar-color: #4a5568 #1a202c;
}

/* 7. PONTOS DE PARADA SUAVES (scroll snapping - opcional) */
@media (min-width: 768px) {
    .scroll-container {
        scroll-snap-type: y proximity;
    }
    
    .scroll-section {
        scroll-snap-align: start;
    }
}

/* 8. ANIMAÇÃO DE APARECIMENTO AO SCROLL */
.fade-in-scroll {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.fade-in-scroll.visible {
    opacity: 1;
    transform: translateY(0);
}

/* 9. SETAS INDICATIVAS (para conteúdo abaixo) */
.scroll-indicator {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    animation: scrollPrompt 2s infinite;
    color: #4299e1;
    font-size: 24px;
}

@keyframes scrollPrompt {
    0%, 100% { transform: translateX(-50%) translateY(0); opacity: 0.5; }
    50% { transform: translateX(-50%) translateY(10px); opacity: 1; }
}

/* 10. DESATIVAR ANIMAÇÕES PARA QUEM PREFERE REDUZIDAS */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}

/* 11. INDICADOR DE PROGRESSO DE SCROLL (opcional) */
.scroll-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, #4299e1, #38a169, #d69e2e);
    z-index: 9999;
    transition: width 0.1s ease;
}
</style>
</body>
</html>

<style>
/* ========== TEMA ESCURO MODERNO PARA BOTÕES DATATABLES ========== */

/* Botões principais do DataTables */
.dt-buttons .dt-button {
    background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%) !important;
    border: 1px solid #4a5568 !important;
    border-radius: 8px !important;
    color: #e2e8f0 !important;
    padding: 8px 16px !important;
    margin: 2px !important;
    font-weight: 500 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
}

/* Hover effect */
.dt-buttons .dt-button:hover {
    background: linear-gradient(135deg, #4a5568 0%, #718096 100%) !important;
    border-color: #63b3ed !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15) !important;
}

/* Active/Focus state */
.dt-buttons .dt-button:active,
.dt-buttons .dt-button:focus {
    background: linear-gradient(135deg, #2d3748 0%, #2d3748 100%) !important;
    border-color: #4299e1 !important;
    outline: 2px solid rgba(66, 153, 225, 0.3) !important;
    outline-offset: 1px !important;
}

/* Ícones dos botões */
.dt-buttons .dt-button span.dt-down-arrow {
    color: #a0aec0 !important;
}

/* Container dos botões */
.dt-buttons {
    padding: 10px !important;
    background: rgba(26, 32, 44, 0.7) !important;
    border-radius: 10px !important;
    display: inline-block !important;
    backdrop-filter: blur(10px) !important;
}

/* ========== TEMA ESCURO PARA O FOOTER ========== */
.main-footer {
    background: linear-gradient(90deg, #1a202c 0%, #2d3748 100%) !important;
    border-top: 1px solid #4a5568 !important;
    color: #cbd5e0 !important;
    padding: 15px 20px !important;
}

.main-footer strong {
    color: #e2e8f0 !important;
    font-weight: 600 !important;
}

.main-footer .float-right {
    color: #a0aec0 !important;
}

/* ========== TEMA ESCURO PARA AS TABELAS ========== */
.dataTables_wrapper {
    background: #1a202c !important;
    border-radius: 10px !important;
    padding: 20px !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
    color: #a0aec0 !important;
}

.dataTables_wrapper .dataTables_filter input,
.dataTables_wrapper .dataTables_length select {
    background: #2d3748 !important;
    border: 1px solid #4a5568 !important;
    color: #e2e8f0 !important;
    border-radius: 6px !important;
    padding: 6px 12px !important;
}

.dataTables_wrapper .dataTables_filter input:focus,
.dataTables_wrapper .dataTables_length select:focus {
    border-color: #4299e1 !important;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1) !important;
}

/* ========== BOTÕES ESPECÍFICOS ========== */
/* Botão Copy */
button.dt-button.buttons-copy {
    background: linear-gradient(135deg, #2b6cb0 0%, #3182ce 100%) !important;
}

/* Botão CSV */
button.dt-button.buttons-csv {
    background: linear-gradient(135deg, #276749 0%, #38a169 100%) !important;
}

/* Botão Excel */
button.dt-button.buttons-excel {
    background: linear-gradient(135deg, #975a16 0%, #d69e2e 100%) !important;
}

/* Botão PDF */
button.dt-button.buttons-pdf {
    background: linear-gradient(135deg, #9b2c2c 0%, #e53e3e 100%) !important;
}

/* Botão Print */
button.dt-button.buttons-print {
    background: linear-gradient(135deg, #553c9a 0%, #805ad5 100%) !important;
}

/* ========== EFECTOS ADICIONAIS ========== */
/* Glow effect nos botões */
.dt-buttons .dt-button {
    position: relative !important;
    overflow: hidden !important;
}

.dt-buttons .dt-button::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.5);
    opacity: 0;
    border-radius: 100%;
    transform: scale(1, 1) translate(-50%);
    transform-origin: 50% 50%;
}

.dt-buttons .dt-button:focus::before {
    animation: ripple 1s ease-out !important;
}

@keyframes ripple {
    0% {
        transform: scale(0, 0);
        opacity: 0.5;
    }
    100% {
        transform: scale(20, 20);
        opacity: 0;
    }
}

/* ========== RESPONSIVIDADE ========== */
@media (max-width: 768px) {
    .dt-buttons {
        display: flex !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
    }
    
    .dt-buttons .dt-button {
        flex: 1 0 auto !important;
        margin: 3px !important;
        min-width: 80px !important;
        font-size: 0.9em !important;
        padding: 6px 10px !important;
    }
}
</style>

<style>
/* ========== TEMA ESCURO COMPLETO PARA A PÁGINA ========== */

/* 1. FUNDO PRINCIPAL DA PÁGINA */
body {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
    color: #cbd5e0 !important;
    min-height: 100vh !important;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif !important;
}

/* 2. FUNDO DO CONTEÚDO PRINCIPAL */
.wrapper,
.content-wrapper,
.main-content {
    background: transparent !important;
}

/* 3. HEADER/NAVBAR (se houver) */
.main-header,
.navbar {
    background: linear-gradient(90deg, #1a202c 0%, #2d3748 100%) !important;
    border-bottom: 1px solid #4a5568 !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3) !important;
}

/* 4. SIDEBAR (se houver) */
.main-sidebar,
.sidebar {
    background: #1a202c !important;
    border-right: 1px solid #4a5568 !important;
}

/* 5. CARDS E CONTAINERS */
.card,
.box,
.content-header,
.content {
    background: rgba(26, 32, 44, 0.8) !important;
    border: 1px solid #4a5568 !important;
    border-radius: 12px !important;
    color: #e2e8f0 !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2) !important;
    backdrop-filter: blur(10px) !important;
}

/* 6. TABELAS */
.table,
.dataTable {
    background: #1a202c !important;
    color: #e2e8f0 !important;
    border-radius: 8px !important;
    overflow: hidden !important;
}

.table thead th,
.dataTable thead th {
    background: #2d3748 !important;
    color: #cbd5e0 !important;
    border-bottom: 2px solid #4a5568 !important;
    font-weight: 600 !important;
    padding: 12px 15px !important;
}

.table tbody td,
.dataTable tbody td {
    border-bottom: 1px solid #4a5568 !important;
    padding: 10px 15px !important;
    background: #1a202c !important;
}

.table tbody tr:hover td,
.dataTable tbody tr:hover td {
    background: #2d3748 !important;
    transition: background 0.3s ease !important;
}

/* 7. BOTÕES DATATABLES (mantendo seu estilo anterior) */
.dt-buttons .dt-button {
    background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%) !important;
    border: 1px solid #4a5568 !important;
    border-radius: 8px !important;
    color: #e2e8f0 !important;
    padding: 8px 16px !important;
    margin: 2px !important;
    font-weight: 500 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
}

.dt-buttons .dt-button:hover {
    background: linear-gradient(135deg, #4a5568 0%, #718096 100%) !important;
    border-color: #63b3ed !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15) !important;
}

.dt-buttons {
    padding: 10px !important;
    background: rgba(26, 32, 44, 0.7) !important;
    border-radius: 10px !important;
    backdrop-filter: blur(10px) !important;
}

/* Botões específicos */
button.dt-button.buttons-copy { background: linear-gradient(135deg, #2b6cb0 0%, #3182ce 100%) !important; }
button.dt-button.buttons-csv { background: linear-gradient(135deg, #276749 0%, #38a169 100%) !important; }
button.dt-button.buttons-excel { background: linear-gradient(135deg, #975a16 0%, #d69e2e 100%) !important; }
button.dt-button.buttons-pdf { background: linear-gradient(135deg, #9b2c2c 0%, #e53e3e 100%) !important; }
button.dt-button.buttons-print { background: linear-gradient(135deg, #553c9a 0%, #805ad5 100%) !important; }

/* 8. FORMULÁRIOS */
input,
select,
textarea {
    background: #2d3748 !important;
    border: 1px solid #4a5568 !important;
    color: #e2e8f0 !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
}

input:focus,
select:focus,
textarea:focus {
    border-color: #4299e1 !important;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2) !important;
    outline: none !important;
}

/* 9. FOOTER (mantendo seu estilo) */
.main-footer {
    background: linear-gradient(90deg, #1a202c 0%, #2d3748 100%) !important;
    border-top: 1px solid #4a5568 !important;
    color: #cbd5e0 !important;
    padding: 15px 20px !important;
    margin-top: 20px !important;
}

.main-footer strong {
    color: #e2e8f0 !important;
    font-weight: 600 !important;
}

.main-footer .float-right {
    color: #a0aec0 !important;
}

/* 10. SCROLLBAR PERSONALIZADA */
::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

::-webkit-scrollbar-track {
    background: #1a202c;
    border-radius: 5px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #4a5568 0%, #718096 100%);
    border-radius: 5px;
    border: 2px solid #1a202c;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #718096 0%, #a0aec0 100%);
}

/* 11. LINKS */
a {
    color: #63b3ed !important;
    text-decoration: none !important;
    transition: color 0.3s ease !important;
}

a:hover {
    color: #90cdf4 !important;
    text-decoration: underline !important;
}

/* 12. PAGINAÇÃO */
.dataTables_paginate .paginate_button {
    background: #2d3748 !important;
    border: 1px solid #4a5568 !important;
    color: #e2e8f0 !important;
    border-radius: 6px !important;
    margin: 2px !important;
}

.dataTables_paginate .paginate_button:hover {
    background: #4a5568 !important;
    border-color: #63b3ed !important;
}

.dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #3182ce 0%, #63b3ed 100%) !important;
    color: white !important;
    border-color: #3182ce !important;
}

/* 13. MODAIS E POPUPS */
.modal-content {
    background: #1a202c !important;
    border: 1px solid #4a5568 !important;
    border-radius: 12px !important;
    color: #e2e8f0 !important;
}

.modal-header {
    border-bottom: 1px solid #4a5568 !important;
    background: #2d3748 !important;
    border-radius: 12px 12px 0 0 !important;
}

.modal-footer {
    border-top: 1px solid #4a5568 !important;
}

/* 14. TOOLTIPS E POPOVERS */
.tooltip-inner,
.popover {
    background: #2d3748 !important;
    color: #e2e8f0 !important;
    border: 1px solid #4a5568 !important;
    border-radius: 8px !important;
}

/* 15. ANIMAÇÕES E TRANSIÇÕES */
.card,
.table,
.dt-button {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

/* 16. RESPONSIVIDADE */
@media (max-width: 768px) {
    body {
        background: #1a202c !important;
    }
    
    .card,
    .box {
        margin: 10px !important;
        border-radius: 10px !important;
    }
    
    .dt-buttons {
        display: flex !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
    }
    
    .dt-buttons .dt-button {
        flex: 1 0 auto !important;
        margin: 3px !important;
        min-width: 70px !important;
        font-size: 0.85em !important;
        padding: 6px 8px !important;
    }
}

/* 17. ESTILOS PARA TEXTOS */
h1, h2, h3, h4, h5, h6 {
    color: #e2e8f0 !important;
    font-weight: 600 !important;
}

.text-muted {
    color: #a0aec0 !important;
}

/* 18. BADGES E LABELS */
.badge,
.label {
    background: linear-gradient(135deg, #4a5568 0%, #718096 100%) !important;
    color: white !important;
    border-radius: 12px !important;
    padding: 4px 10px !important;
    font-weight: 500 !important;
}

/* 19. ALERTS E NOTIFICAÇÕES */
.alert {
    background: rgba(26, 32, 44, 0.9) !important;
    border: 1px solid #4a5568 !important;
    color: #e2e8f0 !important;
    border-radius: 10px !important;
    backdrop-filter: blur(10px) !important;
}

/* 20. GRADIENTES E EFEITOS VISUAIS */
.glass-effect {
    background: rgba(26, 32, 44, 0.7) !important;
    backdrop-filter: blur(10px) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}/* Esconder o botão do Control Sidebar */
[data-toggle="control-sidebar"],
.control-sidebar-toggle {
    display: none !important;
}

/* Esconder o próprio sidebar */
.control-sidebar {
    display: none !important;
}


</style>


<script>
// SOLUÇÃO DIRETA - Exporta exatamente o que está na tela
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                text: 'Copiar',
                exportOptions: {
                    columns: ':visible:not(:last-child)' // Copia tudo menos a última coluna (Ações)
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                filename: 'meus_contatos_' + new Date().getTime(),
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                filename: 'contatos_excel',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                filename: 'contatos_pdf',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            },
            {
                extend: 'print',
                text: 'Imprimir',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                },
                customize: function(win) {
                    // Adiciona um título
                    $(win.document.body).prepend(
                        '<h2 style="text-align:center;">📇 Agenda Eletrônica</h2>' +
                        '<p style="text-align:center;">Contatos exportados em ' + 
                        new Date().toLocaleString('pt-BR') + '</p><hr>'
                    );
                    
                    // Adiciona um rodapé
                    $(win.document.body).append(
                        '<hr><p style="text-align:center;font-size:12px;color:#666;">' +
                        'Sistema AG Versão 2.0 - © 2025 Felipe</p>'
                    );
                }
            }
        ]
    });
});
</script>
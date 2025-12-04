<?php
// conteudo/relatoriopdf.php

// Ativar exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id_user'])) {
    echo "Erro: Usuário não autenticado!";
    exit();
}

// Verificar se o ID foi passado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Erro: ID do usuário não especificado!";
    exit();
}

$id_user = $_GET['id'];

// Caminho para a conexão (ajuste conforme sua estrutura)
$conexao_path = '../config/conexao.php';

if (!file_exists($conexao_path)) {
    echo "Erro: Arquivo de conexão não encontrado em: " . $conexao_path;
    exit();
}

// Incluir conexão
require_once $conexao_path;

try {
    // Consulta para pegar todos os contatos do usuário
    $sql = "SELECT * FROM tb_contatos 
            WHERE id_user = :id_user 
            ORDER BY nome_contatos ASC";
    
    $stmt = $conect->prepare($sql);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->execute();
    
    $contatos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($contatos) == 0) {
        echo "Nenhum contato encontrado para este usuário.";
        exit();
    }
    
} catch (PDOException $e) {
    echo "Erro ao buscar contatos: " . $e->getMessage();
    exit();
}

// Verificar se a biblioteca FPDF existe
$fpdf_path = '../libs/fpdf/fpdf.php';
if (!file_exists($fpdf_path)) {
    // Se FPDF não existir, criar relatório em HTML
    gerarRelatorioHTML($contatos, $id_user);
    exit();
}

// Se FPDF existir, gerar PDF
require_once($fpdf_path);
gerarRelatorioPDF($contatos, $id_user);

// ==============================================
// FUNÇÃO PARA GERAR PDF
// ==============================================
function gerarRelatorioPDF($contatos, $id_user) {
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    
    // Configurar fonte
    $pdf->SetFont('Arial', 'B', 16);
    
    // Título
    $pdf->Cell(0, 10, utf8_decode('Relatório Completo de Contatos'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, utf8_decode('Gerado em: ') . date('d/m/Y H:i:s'), 0, 1, 'C');
    $pdf->Cell(0, 5, utf8_decode('ID do Usuário: ') . $id_user, 0, 1, 'C');
    $pdf->Ln(10);
    
    // Cabeçalho da tabela
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(200, 220, 255);
    
    $pdf->Cell(10, 10, '#', 1, 0, 'C', true);
    $pdf->Cell(70, 10, utf8_decode('Nome'), 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Telefone', 1, 0, 'C', true);
    $pdf->Cell(70, 10, 'E-mail', 1, 1, 'C', true);
    
    // Conteúdo da tabela
    $pdf->SetFont('Arial', '', 9);
    $contador = 1;
    
    foreach ($contatos as $contato) {
        $pdf->Cell(10, 8, $contador++, 1, 0, 'C');
        $pdf->Cell(70, 8, utf8_decode($contato['nome_contatos']), 1, 0);
        $pdf->Cell(40, 8, $contato['fone_contatos'], 1, 0);
        $pdf->Cell(70, 8, utf8_decode($contato['email_contatos']), 1, 1);
    }
    
    // Rodapé
    $pdf->SetY(-15);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 10, utf8_decode('Página ') . $pdf->PageNo(), 0, 0, 'C');
    
    // Configurar cabeçalho para download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="relatorio_contatos_' . $id_user . '_' . date('Ymd_His') . '.pdf"');
    
    // Gerar PDF
    $pdf->Output();
    exit();
}

// ==============================================
// FUNÇÃO PARA GERAR HTML (FALLBACK)
// ==============================================
function gerarRelatorioHTML($contatos, $id_user) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Relatório de Contatos - ID: <?php echo $id_user; ?></title>
        <style>
            body { 
                font-family: Arial, sans-serif; 
                margin: 20px;
                background-color: #f5f5f5;
            }
            .container {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                max-width: 1000px;
                margin: 0 auto;
            }
            h1 { 
                color: #333; 
                text-align: center;
                border-bottom: 2px solid #4e73df;
                padding-bottom: 10px;
            }
            .info {
                background: #f8f9fa;
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 20px;
            }
            table { 
                width: 100%; 
                border-collapse: collapse; 
                margin-top: 20px;
            }
            th, td { 
                border: 1px solid #ddd; 
                padding: 10px; 
                text-align: left;
            }
            th { 
                background: linear-gradient(to right, #4e73df, #224abe);
                color: white;
                text-align: center;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            tr:hover {
                background-color: #f1f1f1;
            }
            .actions {
                margin-top: 30px;
                text-align: center;
            }
            .btn {
                padding: 10px 20px;
                margin: 0 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
            }
            .btn-print {
                background: #4e73df;
                color: white;
            }
            .btn-download {
                background: #28a745;
                color: white;
            }
            @media print {
                .actions { display: none; }
                .info { display: none; }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>📄 Relatório Completo de Contatos</h1>
            
            <div class="info">
                <p><strong>Usuário ID:</strong> <?php echo $id_user; ?></p>
                <p><strong>Data de geração:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
                <p><strong>Total de contatos:</strong> <?php echo count($contatos); ?></p>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th style="width: 15%">Data Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cont = 1; ?>
                    <?php foreach ($contatos as $contato): ?>
                    <tr>
                        <td style="text-align:center"><?php echo $cont++; ?></td>
                        <td><?php echo htmlspecialchars($contato['nome_contatos']); ?></td>
                        <td><?php echo htmlspecialchars($contato['fone_contatos']); ?></td>
                        <td><?php echo htmlspecialchars($contato['email_contatos']); ?></td>
                        <td>
                            <?php 
                            if (isset($contato['data_cadastro']) && !empty($contato['data_cadastro'])) {
                                echo date('d/m/Y', strtotime($contato['data_cadastro']));
                            } else {
                                echo '--';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="actions">
                <button class="btn btn-print" onclick="window.print()">
                    🖨️ Imprimir Relatório
                </button>
                <button class="btn btn-download" onclick="exportToCSV()">
                    📥 Exportar como CSV
                </button>
                <button class="btn" onclick="window.close()">
                    ❌ Fechar
                </button>
            </div>
        </div>
        
        <script>
        // Função para exportar como CSV
        function exportToCSV() {
            let csv = [];
            let rows = document.querySelectorAll("table tr");
            
            for (let i = 0; i < rows.length; i++) {
                let row = [], cols = rows[i].querySelectorAll("td, th");
                
                for (let j = 0; j < cols.length; j++) {
                    row.push(cols[j].innerText);
                }
                csv.push(row.join(","));        
            }
            
            // Download CSV
            let csvContent = "data:text/csv;charset=utf-8," + csv.join("\n");
            let encodedUri = encodeURI(csvContent);
            let link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "relatorio_contatos_<?php echo $id_user; ?>_<?php echo date('Ymd_His'); ?>.csv");
            document.body.appendChild(link);
            link.click();
        }
        
        // Imprimir automaticamente ao abrir (opcional)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 1000);
        // }
        </script>
    </body>
    </html>
    <?php
}
?>
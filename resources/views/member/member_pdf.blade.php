<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Solution Code | Relatório de Membros</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .table-container {
            width: 80%;
            margin: 20px auto;
            overflow-x: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
            transition: 0.3s;
        }
        @media (max-width: 600px) {
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2>Lista de Membros</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Data de Criação</th>
                    <th>Última Atualização</th>
                </tr>
            </thead>
            <tbody>
            @foreach($getRecord as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->code_member}}</td>
                    <td>{{$value->name_member}}</td>
                    <td>{{$value->address}}</td>
                    <td>{{$value->telefone}}</td>
                    <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                    <td>{{date('d-m-Y H:i A', strtotime($value->updated_at))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
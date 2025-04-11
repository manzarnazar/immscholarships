<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>IMS Program List</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }
        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
            color: #013220;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .print-container {
            max-width: 900px;
            margin: 0 auto;
        }
        /* Print Button */
        .no-print button {
            background-color: #013220;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .no-print button:hover {
            background-color: #0b3d0b;
        }
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        table thead tr {
            background: linear-gradient(45deg, #013220, #0b3d0b);
            color: #fff;
        }
        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th:first-child, table td:first-child {
            text-align: center;
            width: 50px;
        }
        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
        table tbody tr:hover {
            background-color: #d0e8d0;
        }
        /* Footer */
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
        /* Responsive Print Styles */
        @media print {
            .no-print {
                display: none;
            }
            body {
                padding: 0;
                margin: 0;
            }
            .print-container {
                margin: 0;
            }
            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <h1>IMS Program List</h1>
        <div class="no-print" style="text-align: center; margin-bottom: 20px;">
            <button onclick="window.print()">Print</button>
        </div>
        <hr>
        @php
            // Get unique programs by title and sort alphabetically.
            $uniqueScholarships = $scholarships->unique('title')->sortBy('title');
        @endphp
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($uniqueScholarships as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ strtoupper($item->title) }}</td>
                        <td>{{ strtoupper($item->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            IMS Program List - Printed on {{ date('F j, Y') }}
        </div>
    </div>
</body>
</html>





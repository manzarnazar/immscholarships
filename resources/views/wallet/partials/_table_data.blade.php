@foreach ($withdraw_requests as $item)
                    <tr>
                        <td>{{ strtoupper($item->bank_name) }}</td>
                        <td>{{ strtoupper($item->acc_no) }}</td>
                        
                            <td>${{ strtoupper($item->amount) }}</td>
                       
                        <td>
                            <span class="badge bg-info">
                                {{ strtoupper($item->status) }}
                            </span>
                        </td>
                       <td>{{ strtoupper($item->created_at) }}</td>
                    </tr>
                    @endforeach

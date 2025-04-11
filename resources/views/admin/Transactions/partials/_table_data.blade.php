@foreach ($transactions as $item)
                    <tr>
                         <td>{{ strtoupper($item->applicationId) }}</td>
                          <td>{{ strtoupper($item->tx_ref) }}</td>
                        <td>{{ strtoupper($item->user->name) }}</td>
                          <td>{{ strtoupper($item->user->email) }}</td>
                            <td>${{ strtoupper($item->amount) }}</td>
                            <td>{{ strtoupper($item->status) }}</td>
                            <td>{{ strtoupper($item->created_at) }}</td>
                       
                       
                      
                    </tr>
                    @endforeach

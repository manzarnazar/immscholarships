@foreach ($withdraw_requests as $item)
                    <tr>
                        
                          <td>{{ strtoupper($item->bank_name) }}</td>
                           <td>{{ strtoupper($item->acc_no) }}</td>
                        <td>{{ strtoupper($item->user->name) }}</td>
                          <td>{{ strtoupper($item->user->email) }}</td>
                            <td>${{ strtoupper($item->amount) }}</td>
                            <td>
                    @if ($item->status == 'pending')
                        <form action="{{ route('transactions.updateStatus', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Mark as Complete</button>
                        </form>
                    @else
                        <span class="badge bg-success">Completed</span>
                    @endif
                </td>
                            <td>{{ strtoupper($item->created_at) }}</td>
                       
                       
                      
                    </tr>
                    @endforeach

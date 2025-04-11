@foreach ($referrals as $item)
                    <tr>
                        <td>{{ strtoupper($item->name) }}</td>
                          <td>{{ strtoupper($item->email) }}</td>
                            <td>${{ strtoupper($item->commission) }}</td>
                       
                        <td>
                            <span class="badge bg-info">
                                {{ strtoupper($item->status) }}
                            </span>
                        </td>
                      
                    </tr>
                    @endforeach

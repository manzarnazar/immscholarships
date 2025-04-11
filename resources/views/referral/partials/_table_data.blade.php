@foreach ($referrals as $item)
                    <tr>
                        <td>{{ strtoupper($item->referrer_name) }}</td>
                        <td>{{ strtoupper($item->referrer_email) }}</td>
                        
                            <td>{{ strtoupper($item->referred_name) }}</td>
                       
                        <td>
                            <span class="badge bg-info">
                                {{ strtoupper($item->referred_email) }}
                            </span>
                        </td>
                       <td>{{ strtoupper($item->referral_date) }}</td>
                    </tr>
                    @endforeach
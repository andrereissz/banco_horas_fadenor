<div>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #f4f7f6;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table width="600" border="0" cellpadding="0" cellspacing="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">

                    <tr>
                        <td style="padding: 40px 40px 20px 40px; text-align: left;">
                            <h1 style="margin: 0; font-size: 24px; color: #2d3748; font-weight: 600;">
                                Solicitação de Cadastro de Bolsista
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 30px 40px; text-align: left;">
                            <p style="margin: 0 0 20px 0; font-size: 16px; line-height: 1.6; color: #4a5568;">
                                Prezado(a) Professor(a),
                            </p>
                            <p style="margin: 0; font-size: 16px; line-height: 1.6; color: #4a5568; text-align: justify;">
                                Referente ao projeto <strong>{{ $bolsa->projeto_nome }} - {{ $bolsa->projeto_num }}</strong>, solicitamos que comunique ao bolsista <strong>{{ $bolsa->nome }}</strong> que é imprescindível o preenchimento de seus dados cadastrais e o anexo da documentação solicitada através do link abaixo:
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 30px 40px; text-align: center;">
                            <a href="" target="_blank" style="background-color: #3490dc; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; display: inline-block;">
                                Acessar Ficha de Cadastro
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 30px 40px;">
                            <div style="background-color: #edf2f7; border-left: 4px solid #3490dc; padding: 20px;">
                                <p style="margin: 0 0 15px 0; font-size: 16px; font-weight: bold; color: #2d3748;">
                                    Observações Importantes:
                                </p>
                                <ul style="margin: 0; padding-left: 20px; font-size: 15px; line-height: 1.7; color: #4a5568;">
                                    <li style="margin-bottom: 15px;">
                                        É necessário enviar mensalmente o <strong>atestado de frequência</strong> (modelo em anexo) de todos os bolsistas.
                                    </li>
                                    <li style="margin-bottom: 15px;">
                                        Em virtude às exigências da FAPEMIG, as assinaturas nos atestados de frequência devem ser <strong>digitais ou manuais</strong> (nesse caso, com envio da cópia escaneada), para evitar problemas com assinaturas editadas.
                                    </li>
                                    <li>
                                        A documentação inicial deve ser enviada <strong style="color: #e53e3e;">até o dia 20 de cada mês</strong>. O não cumprimento do prazo implicará no não recebimento da bolsa.
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 40px 40px; text-align: left;">
                            <p style="margin: 30px 0 5px 0; font-size: 16px; line-height: 1.6; color: #4a5568;">
                                Agradecemos sua colaboração e atenção.
                            </p>
                            <p style="margin: 0; font-size: 16px; line-height: 1.6; color: #4a5568;">
                                Atenciosamente,
                            </p>
                            <p style="margin: 10px 0 0 0; font-size: 16px; font-weight: bold; color: #2d3748;">
                                {{ $user->name }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 30px 40px; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 20px 0 0 0; font-size: 12px; line-height: 1.6; color: #718096; text-align: center;">
                                Em caso de dúvidas, entre em contato pelo e-mail: {{ $user->email }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

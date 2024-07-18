<?php

use App\SmsTrigger;
use Illuminate\Database\Seeder;

class SmsTriggersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criar gatilhos de SMS
        $sms_triggers = [
            [
                'name' => 'Admissão de membro (Pago)',
                'alias' => 'member_admission_with_paid_invoice',
                'message' => 'Oi %s, bem-vindo(a) ao %s. Seu pagamento de R$ %u referente à sua fatura nº %s foi recebido. Obrigado e esperamos vê-lo(a) em ação em breve. Bom dia!',
                'status' => '0',
            ],
            [
                'name' => 'Admissão de membro (Parcial)',
                'alias' => 'member_admission_with_partial_invoice',
                'message' => 'Oi %s, bem-vindo(a) ao %s. Seu pagamento de R$ %u referente à sua fatura nº %s foi recebido. O valor pendente a ser pago é de R$ %u. Obrigado!',
                'status' => '0',
            ],
            [
                'name' => 'Admissão de membro (Não pago)',
                'alias' => 'member_admission_with_unpaid_invoice',
                'message' => 'Oi %s, bem-vindo(a) ao %s. Seu pagamento de R$ %u está pendente referente à sua fatura nº %s. Obrigado!',
                'status' => '0',
            ],
            [
                'name' => 'Colocação de consulta',
                'alias' => 'enquiry_placement',
                'message' => 'Oi %s, obrigado pela sua consulta com o %s. Adoraríamos ouvir de você em breve. Bom dia!',
                'status' => '0',
            ],
            [
                'name' => 'Acompanhamento',
                'alias' => 'followup',
                'message' => 'Oi %s, isto é referente à consulta que você colocou no %s. Gostaríamos de saber quando você gostaria de começar. Bom dia!',
                'status' => '0',
            ],
            [
                'name' => 'Renovação de assinatura (Pago)',
                'alias' => 'subscription_renewal_with_paid_invoice',
                'message' => 'Oi %s, sua assinatura foi renovada com sucesso. Seu pagamento de R$ %u referente à sua fatura nº %s foi recebido. Obrigado!',
                'status' => '0',
            ],
            [
                'name' => 'Renovação de assinatura (Parcial)',
                'alias' => 'subscription_renewal_with_partial_invoice',
                'message' => 'Oi %s, sua assinatura foi renovada com sucesso. Seu pagamento de R$ %u referente à sua fatura nº %s foi recebido. O valor pendente a ser pago é de R$ %u. Obrigado!',
                'status' => '0',
            ],
            [
                'name' => 'Renovação de assinatura (Não pago)',
                'alias' => 'subscription_renewal_with_unpaid_invoice',
                'message' => 'Oi %s, sua assinatura foi renovada com sucesso. Seu pagamento de R$ %u está pendente referente à sua fatura nº %s. Obrigado!',
                'status' => '0',
            ],
            [
                'name' => 'Assinatura expirada',
                'alias' => 'subscription_expiring',
                'message' => 'Oi %s, faltam poucos dias para renovar sua assinatura da academia. Por favor, renove antes de %s. Obrigado!',
                'status' => '0',
            ],
            [
                'name' => 'Assinatura expirada',
                'alias' => 'subscription_expired',
                'message' => 'Oi %s, sua assinatura da academia expirou em %s. Por favor, renove em breve!',
                'status' => '0',
            ],
            [
                'name' => 'Pagamento recebido',
                'alias' => 'payment_recieved',
                'message' => 'Oi %s, seu pagamento de R$ %u foi recebido referente à sua fatura nº %s. Obrigado!',
                'status' => '0',
            ],
            [
                'name' => 'Fatura pendente',
                'alias' => 'pending_invoice',
                'message' => 'Oi %s, seu pagamento de R$ %u está pendente referente à sua fatura nº %s. Por favor, pague em breve!',
                'status' => '0',
            ],
            [
                'name' => 'Alerta de despesa',
                'alias' => 'expense_alert',
                'message' => 'Oi, você tem uma despesa programada para %s no valor de R$ %u em %s. Obrigado!',
                'status' => '0',
            ],
            [
                'name' => 'Parabéns pelo aniversário',
                'alias' => 'member_birthday',
                'message' => 'Oi %s, a equipe %s deseja um feliz aniversário :) Aproveite seu dia!',
                'status' => '0',
            ],
            [
                'name' => 'Pagamento com cheque',
                'alias' => 'payment_with_cheque',
                'message' => 'Oi %s, seu cheque de R$ %u com o número de cheque %u foi recebido referente à sua fatura nº %s. Atenciosamente, %s.',
                'status' => '0',
            ],
        ];

        foreach ($sms_triggers as $sms_trigger) {
            SmsTrigger::create($sms_trigger);
        }
    }
}

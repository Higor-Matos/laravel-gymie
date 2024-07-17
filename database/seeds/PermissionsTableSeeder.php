<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criar permissões
        $permissions = [
          [
            'name' => 'manage-gymie',
            'display_name' => 'Gerenciar Gymie',
            'group_key' => 'Global',
          ],
          [
            'name' => 'view-dashboard-quick-stats',
            'display_name' => 'Ver estatísticas rápidas no painel',
            'group_key' => 'Dashboard',
          ],
          [
            'name' => 'view-dashboard-charts',
            'display_name' => 'Ver gráficos no painel',
            'group_key' => 'Dashboard',
          ],
          [
            'name' => 'view-dashboard-members-tab',
            'display_name' => 'Ver aba de membros no painel',
            'group_key' => 'Dashboard',
          ],
          [
            'name' => 'view-dashboard-enquiries-tab',
            'display_name' => 'Ver aba de consultas no painel',
            'group_key' => 'Dashboard',
          ],
          [
            'name' => 'add-member',
            'display_name' => 'Adicionar membro',
            'group_key' => 'Membros',
          ],
          [
            'name' => 'view-member',
            'display_name' => 'Ver detalhes do membro',
            'group_key' => 'Membros',
          ],
          [
            'name' => 'edit-member',
            'display_name' => 'Editar detalhes do membro',
            'group_key' => 'Membros',
          ],
          [
            'name' => 'delete-member',
            'display_name' => 'Deletar membro',
            'group_key' => 'Membros',
          ],
          [
            'name' => 'add-plan',
            'display_name' => 'Adicionar planos',
            'group_key' => 'Planos',
          ],
          [
            'name' => 'view-plan',
            'display_name' => 'Ver detalhes do plano',
            'group_key' => 'Planos',
          ],
          [
            'name' => 'edit-plan',
            'display_name' => 'Editar detalhes do plano',
            'group_key' => 'Planos',
          ],
          [
            'name' => 'delete-plan',
            'display_name' => 'Deletar planos',
            'group_key' => 'Planos',
          ],
          [
            'name' => 'add-subscription',
            'display_name' => 'Adicionar assinatura',
            'group_key' => 'Assinaturas',
          ],
          [
            'name' => 'edit-subscription',
            'display_name' => 'Editar detalhes da assinatura',
            'group_key' => 'Assinaturas',
          ],
          [
            'name' => 'renew-subscription',
            'display_name' => 'Renovar assinatura',
            'group_key' => 'Assinaturas',
          ],
          [
            'name' => 'view-invoice',
            'display_name' => 'Ver fatura',
            'group_key' => 'Faturas',
          ],
          [
            'name' => 'add-payment',
            'display_name' => 'Adicionar pagamentos',
            'group_key' => 'Pagamentos',
          ],
          [
            'name' => 'view-subscription',
            'display_name' => 'Ver detalhes da assinatura',
            'group_key' => 'Assinaturas',
          ],
          [
            'name' => 'view-payment',
            'display_name' => 'Ver detalhes do pagamento',
            'group_key' => 'Pagamentos',
          ],
          [
            'name' => 'edit-payment',
            'display_name' => 'Editar detalhes do pagamento',
            'group_key' => 'Pagamentos',
          ],
          [
            'name' => 'manage-members',
            'display_name' => 'Gerenciar membros',
            'group_key' => 'Membros',
          ],
          [
            'name' => 'manage-plans',
            'display_name' => 'Gerenciar planos',
            'group_key' => 'Planos',
          ],
          [
            'name' => 'manage-subscriptions',
            'display_name' => 'Gerenciar assinaturas',
            'group_key' => 'Assinaturas',
          ],
          [
            'name' => 'manage-invoices',
            'display_name' => 'Gerenciar faturas',
            'group_key' => 'Faturas',
          ],
          [
            'name' => 'manage-payments',
            'display_name' => 'Gerenciar pagamentos',
            'group_key' => 'Pagamentos',
          ],
          [
            'name' => 'manage-users',
            'display_name' => 'Gerenciar usuários',
            'group_key' => 'Usuários',
          ],
          [
            'name' => 'add-enquiry',
            'display_name' => 'Adicionar consulta',
            'group_key' => 'Consultas',
          ],
          [
            'name' => 'view-enquiry',
            'display_name' => 'Ver detalhes da consulta',
            'group_key' => 'Consultas',
          ],
          [
            'name' => 'edit-enquiry',
            'display_name' => 'Editar detalhes da consulta',
            'group_key' => 'Consultas',
          ],
          [
            'name' => 'add-enquiry-followup',
            'display_name' => 'Adicionar acompanhamento de consulta',
            'group_key' => 'Consultas',
          ],
          [
            'name' => 'edit-enquiry-followup',
            'display_name' => 'Editar acompanhamento de consulta',
            'group_key' => 'Consultas',
          ],
          [
            'name' => 'transfer-enquiry',
            'display_name' => 'Transferir consulta',
            'group_key' => 'Consultas',
          ],
          [
            'name' => 'manage-enquiries',
            'display_name' => 'Gerenciar consultas',
            'group_key' => 'Consultas',
          ],
          [
            'name' => 'add-expense',
            'display_name' => 'Adicionar despesa',
            'group_key' => 'Despesas',
          ],
          [
            'name' => 'view-expense',
            'display_name' => 'Ver detalhes da despesa',
            'group_key' => 'Despesas',
          ],
          [
            'name' => 'edit-expense',
            'display_name' => 'Editar detalhes da despesa',
            'group_key' => 'Despesas',
          ],
          [
            'name' => 'manage-expenses',
            'display_name' => 'Gerenciar despesas',
            'group_key' => 'Despesas',
          ],
          [
            'name' => 'add-expenseCategory',
            'display_name' => 'Adicionar categoria de despesa',
            'group_key' => 'Categorias de Despesa',
          ],
          [
            'name' => 'view-expenseCategory',
            'display_name' => 'Ver categorias de despesa',
            'group_key' => 'Categorias de Despesa',
          ],
          [
            'name' => 'edit-expenseCategory',
            'display_name' => 'Editar detalhes da categoria de despesa',
            'group_key' => 'Categorias de Despesa',
          ],
          [
            'name' => 'delete-expenseCategory',
            'display_name' => 'Deletar categoria de despesa',
            'group_key' => 'Categorias de Despesa',
          ],
          [
            'name' => 'manage-expenseCategories',
            'display_name' => 'Gerenciar categorias de despesa',
            'group_key' => 'Categorias de Despesa',
          ],
          [
            'name' => 'manage-settings',
            'display_name' => 'Gerenciar configurações',
            'group_key' => 'Global',
          ],
          [
            'name' => 'cancel-subscription',
            'display_name' => 'Cancelar assinatura',
            'group_key' => 'Assinaturas',
          ],
          [
            'name' => 'manage-services',
            'display_name' => 'Gerenciar serviços',
            'group_key' => 'Serviços',
          ],
          [
            'name' => 'add-service',
            'display_name' => 'Adicionar serviços',
            'group_key' => 'Serviços',
          ],
          [
            'name' => 'edit-service',
            'display_name' => 'Editar detalhes do serviço',
            'group_key' => 'Serviços',
          ],
          [
            'name' => 'view-service',
            'display_name' => 'Ver detalhes do serviço',
            'group_key' => 'Serviços',
          ],
          [
            'name' => 'manage-sms',
            'display_name' => 'Gerenciar SMS',
            'group_key' => 'SMS',
          ],
          [
            'name' => 'pagehead-stats',
            'display_name' => 'Ver contagens no cabeçalho da página',
            'group_key' => 'Global',
          ],
          [
            'name' => 'view-dashboard-expense-tab',
            'display_name' => 'Ver aba de despesas no painel',
            'group_key' => 'Dashboard',
          ],
          [
            'name' => 'print-invoice',
            'display_name' => 'Imprimir faturas',
            'group_key' => 'Faturas',
          ],
          [
            'name' => 'delete-invoice',
            'display_name' => 'Deletar faturas',
            'group_key' => 'Faturas',
          ],
          [
            'name' => 'delete-subscription',
            'display_name' => 'Deletar assinaturas',
            'group_key' => 'Assinaturas',
          ],
          [
            'name' => 'delete-payment',
            'display_name' => 'Deletar transações de pagamento',
            'group_key' => 'Pagamentos',
          ],
          [
            'name' => 'delete-expense',
            'display_name' => 'Deletar detalhes da despesa',
            'group_key' => 'Despesas',
          ],
          [
            'name' => 'delete-service',
            'display_name' => 'Deletar detalhes do serviço',
            'group_key' => 'Serviços',
          ],
          [
            'name' => 'add-discount',
            'display_name' => 'Adicionar desconto na fatura',
            'group_key' => 'Faturas',
          ],
          [
            'name' => 'change-subscription',
            'display_name' => 'Upgrade ou downgrade de assinatura',
            'group_key' => 'Assinaturas',
          ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}

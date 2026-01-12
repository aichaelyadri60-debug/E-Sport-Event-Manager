<?php
final class FinancialEngine
{
    private const TAX_RATE = 0.20;  
    private const AGENT_FEE = 0.05;  

    public static function calculateTotal(float $valeur_montant): float
    {
        if ($valeur_montant <= 0) {
            throw new Exception("Valeur marchande invalide");
        }

        $tax = $valeur_montant * self::TAX_RATE;
        $agent = $valeur_montant * self::AGENT_FEE;

        return $valeur_montant + $tax + $agent;
    }

    public static function checkBudget(float $marketValue, float $budget): float
    {
        $total = self::calculateTotal($marketValue);

        if ($total > $budget) {
            throw new Exception("Montant supérieur au budget disponible");
        }

        return $total;
    }
}

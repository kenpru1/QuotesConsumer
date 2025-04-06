<?php

namespace kenpru1\quotesconsumer\Contracts;

interface QuotesServiceInterface
{
    /**
     * Obtener todas las citas
     *
     * @return array
     */
    public function getAllQuotes(): array;

    /**
     * Obtener una cita aleatoria
     *
     * @return array|null
     */
    public function getRandomQuote(): ?array;

    /**
     * Obtener una cita por ID
     *
     * @param int $id
     * @return array|null
     */
    public function getQuoteById(int $id): ?array;
}
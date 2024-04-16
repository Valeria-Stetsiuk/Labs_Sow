<?php


namespace models;


class TransportLab extends CoreModel
{
    const STATUS_ACTIVE = 0;
    const STATUS_NOT_ACTIVE = 1;


    /**
     * @inheritDoc
     */
    protected function setNameTable(): string
    {
        return 'transport_lab';
    }

    public function getAll()
    {
        return $this->db->query(
            sprintf('SELECT * FROM %s', $this->setNameTable())
        )->row_array();
    }

    public function getAllActive()
    {
        return $this->db->query(
            sprintf('SELECT id, surname, model,transport,number FROM %s WHERE deleted = %s', $this->setNameTable(), self::STATUS_ACTIVE)
        )->row_array();
    }

    public function getBySql(string $sql)
    {
        return $this->db->query($sql)->row_array();
    }


}
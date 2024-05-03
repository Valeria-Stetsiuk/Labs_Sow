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

    public function create(string $surname, string $model, string $transport, string $number )
    {
        $this->setType('pdo');

        $sql = sprintf(
            'INSERT INTO %s (surname, model, transport, `number`, deleted) VALUES (?, ?, ?, ?, ?)',
            $this->setNameTable()
        );

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $surname);
        $stmt->bindParam(2, $model);
        $stmt->bindParam(3, $transport);
        $stmt->bindParam(4, $number);
        $deleted = 0;
        $stmt->bindParam(5, $deleted);
        $stmt->execute();

    }

    public function updateById(
        string $id,
        string $surname = '',
        string $model = '',
        string $transport = '',
        string $number = '',
        int $deleted = 0
    ){

        $this->setType('pdo');
        $sql = sprintf(
            'UPDATE %s SET surname = :surname, model = :model, transport = :transport, `number` = :number, deleted = :deleted WHERE id = :id',
            $this->setNameTable()
        );

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':surname', $surname);
        $stmt->bindValue(':model', $model);
        $stmt->bindValue(':transport', $transport);
        $stmt->bindValue(':number', $number);
        $stmt->bindValue(':deleted', $deleted);
        $stmt->execute();

    }

    public function deleteById(int $id)
    {

        $this->setType('pdo');

        $sql = sprintf(
            'DELETE FROM %s WHERE id = :id',
            $this->setNameTable()
        );

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

}
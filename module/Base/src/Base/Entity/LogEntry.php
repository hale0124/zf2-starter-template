<?php

namespace Base\Entity;

/**
 * LogEntry entity class
 */
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Loggable\Entity\MappedSuperclass\AbstractLogEntry;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Loggable\Entity\Repository\LogEntryRepository")
 * @ORM\Table(name="log_entry", indexes={
 *      @ORM\index(name="log_class_lookup_idx", columns={"object_class"}),
 *      @ORM\index(name="log_date_lookup_idx", columns={"logged_at"}),
 *      @ORM\index(name="log_user_lookup_idx", columns={"username"}),
 *      @ORM\index(name="log_version_lookup_idx", columns={"object_id", "object_class", "version"})
 * })
 */
class LogEntry extends AbstractLogEntry
{
}

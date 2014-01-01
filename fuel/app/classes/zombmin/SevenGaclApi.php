<?php

/**
 * $value always serves as an identifier foreach group/object
 */

class SevenGaclApi {
    private $gacl_api;

    public function __construct() {
        $this->gacl_api = new gacl_api(Config::getGaclOptions());
    }

    /**
     * Create an Access Control Object (ACO) section. 
     * Sections serve no other purpose than to categorize ACOs.
     *
     * @param type $name
     * @param type $value
     * @param type $order
     * @param type $hidden
     * @return int section id
     */
    public function addACOSection($name, $value, $order, $hidden=0)
    {
        return $this->gacl_api->add_object_section($name, $value,
                                            $order, $hidden, 'ACO');
    }
    /**
     * Create an Access Control Object (ACO)
     * You can think of ACO's as "Actions".
     *
     * @param string $section_value ACOSection name
     * @param string $name
     * @param int $value
     * @param int $order
     * @param int $hidden
     * @return int ACO id
     */
    public function addACO($section_value, $name, $value, $order, $hidden=0) 
    {
        return $this->acl_api->add_object($section_value, $name, $value,
                                            $order, $hidden, 'ACO');

    }
    /**
     * Create an Access Request Objects (ARO) section.
     * Sections serve no other purpose than to categorize AROs.
     *
     * @param type $name
     * @param type $value
     * @param type $order
     * @param type $hidden
     * @return int section id
     */
    public function addAROSection($name, $value, $order, $hidden=0)
    {
        return $this->gacl_api->add_object_section($name, $value,
                                            $order, $hidden, 'ARO');
    }
    /**
     * Create an Access Request Objects (ARO) group.
     * These groups hold single ARO's on wich ACL rules can be applied
     *
     * @param type $value
     * @param type $name
     * @param type $parent_id
     * @return int group id
     */
    public function addAROGroup($value, $name, $parent_id=0)
    {
        return $this->gacl_api->add_group($value, $name, $parent_id, 'ARO');
    }
    /**
     * Add ARO's to ARO groups
     *
     * @param type $group_id
     * @param type $object_section_value
     * @param type $object_value
     */
    public function addToAROGroup($group_id, $object_section_value,
                                                                $object_value)
    {
        return $this->gacl_api->add_group_object($group_id,
                            $object_section_value, $object_value, 'ARO');
    }
    /**
     * Create an Access Request Objects (ARO)
     * You can think of ARO's as Entities that want to perform actions.
     *
     * Notice the Object Type. In most cases you'll want to make the ARO
     * value for users a unique User ID
     *
     * @param string $section_value AROSection name
     * @param string $name
     * @param int $value
     * @param int $order
     * @param int $hidden
     * @return int ARO id
     */
    public function addARO($section_value, $name, $value, $order, $hidden=0)
    {
        return $this->acl_api->add_object($section_value, $name, $value,
                                            $order, $hidden, 'ACO');

    }
    /**
     * Create an Access eXtension Objects (AXO) section.
     * Sections serve no other purpose than to categorize AROs.
     *
     * @param type $name
     * @param type $value
     * @param type $order
     * @param type $hidden
     * @return int section id
     */
    public function addAXOSection($name, $value, $order, $hidden=0)
    {
        return $this->gacl_api->add_object_section($name, $value,
                                            $order, $hidden, 'AXO');
    }
    /**
     * Create an Access eXtension Objects (AXO)
     * You can think of AXO's as Objects to perform an action on for entities.
     *
     * @param string $section_value AROSection name
     * @param string $name
     * @param int $value
     * @param int $order
     * @param int $hidden
     * @return int AXO id
     */
    public function addAXO($section_value, $name, $value, $order, $hidden=0)
    {
        return $this->gacl_api->add_object($section_value, $name, $value,
                                            $order, $hidden, 'ACO');

    }
    /**
     * get ARO group id by group_value
     *
     * @param string $aro_group_value
     * @return int aco_group_id
     */
    public function getAROGroupID($aro_group_value)
    {
        return $this->gacl_api->get_group_id($aro_group_value, null, 'ARO');
    }
    /**
     * get ACO group id by group_value
     *
     * @param string $aco_group_value
     * @return int aco_group_id
     */
    public function getACOGroupID($aco_group_value)
    {
        return $this->gacl_api->get_group_id($aco_group_value, null, 'ACO');
    }
    /**
     * get ARO id
     *
     * @param type $aro_section_value
     * @param string $aro_value
     * @return int
     */
    public function getAROID($aro_section_value, $aro_value)
    {
        return $this->gacl_api->get_object_id($aro_section_value, $aro_value,
                                                                        'ARO');
    }
    /**
     * get ACO id
     *
     * @param type $aco_section_value
     * @param string $aco_value
     * @return int
     */
    public function getACOID($aco_section_value, $aco_value)
    {
        return $this->gacl_api->get_object_id($aco_section_value, $aco_value,
                                                                        'ACO');
    }
    /**
     * delete one ARO object from AROgroup
     *
     * @param type $aro_group_id
     * @param type $aro_object_value
     */
    public function delAROFromGroup($aro_group_id, $aro_object_value)
    {
        return $this->gacl_api->del_group_object($aro_group_id, null,
                                                 $aro_object_value, 'ARO');
    }
    /**
     * delete one ACO object from ACOgroup
     * 
     * @param type $aco_group_id
     * @param type $aco_object_value
     */
    public function delACOFromGroup($aco_group_id, $aco_object_value)
    {
        return $this->gacl_api->del_group_object($aco_group_id, null,
                                                 $aco_object_value, 'ACO');
    }

    /**
     * Add ACL by ACOs and AROGroups
     *
     * $aco_array = array('access' =>
     *                      array('cockpit','engines','guns','lounge') );
     *
     * @param array $aco_array Associative array, with ACO Section Value =>
     *                          array( ACO Values ) pairs.
     * @param array $aro_group_ids array of groups ids
     * @param bool $allow
     */
    public function addACLForGroup($aco_array, $aro_group_ids, $allow)
    {
        return $this->gacl_api->add_acl($aco_array, null, $aro_group_ids, null,
                                            null, $allow, 1, null, null);
    }
    /**
     * Add ACL by ACOs and AROs
     *
      * @param array $aco_array Associative array, with ACO Section Value =>
     *                          array( ACO Values ) pairs.
     * @param array $aro_array Associative array, with ARO Section Value =>
     *                          array( ARO Values ) pairs.
     * @param type $allow
     */
    public function addACLForARO($aco_array, $aro_array, $allow)
    {
        return $this->gacl_api->add_acl($aco_array, $aro_array, null, null,
                                            null, $allow, 1, null, null);
    }
}

<?php

/**
 * @file classes/submission/PKPAuthor.inc.php
 *
 * Copyright (c) 2000-2012 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class PKPAuthor
 * @ingroup submission
 * @see PKPAuthorDAO
 *
 * @brief Author metadata class.
 */
// $Id$


class PKPAuthor extends DataObject {

    /**
     * Constructor.
     */
    function PKPAuthor() {
        parent::DataObject();
    }

    /**
     * Get the author's complete name.
     * Includes first name, middle name (if applicable), and last name.
     * @return string
     */
    function getFullName() {
        return $this->getData('firstName') . ' ' . ($this->getData('middleName') != '' ? $this->getData('middleName') . ' ' : '') . $this->getData('lastName');
    }

    //
    // Get/set methods

    //

	/**
     * Get ID of author.
     * @return int
     */
    function getAuthorId() {
        if (Config::getVar('debug', 'deprecation_warnings'))
            trigger_error('Deprecated function.');
        return $this->getId();
    }

    /**
     * Set ID of author.
     * @param $authorId int
     */
    function setAuthorId($authorId) {
        if (Config::getVar('debug', 'deprecation_warnings'))
            trigger_error('Deprecated function.');
        return $this->setId($authorId);
    }

    /**
     * Get first name.
     * @return string
     */
    function getFirstName() {
        return $this->getData('firstName');
    }

    /**
     * Set first name.
     * @param $firstName string
     */
    function setFirstName($firstName) {
        return $this->setData('firstName', $firstName);
    }

    /**
     * Get middle name.
     * @return string
     */
    function getMiddleName() {
        return $this->getData('middleName');
    }

    /**
     * Set middle name.
     * @param $middleName string
     */
    function setMiddleName($middleName) {
        return $this->setData('middleName', $middleName);
    }

    /**
     * Get initials.
     * @return string
     */
    function getInitials() {
        return $this->getData('initials');
    }

    /**
     * Set initials.
     * @param $initials string
     */
    function setInitials($initials) {
        return $this->setData('initials', $initials);
    }

    /**
     * Get last name.
     * @return string
     */
    function getLastName() {
        return $this->getData('lastName');
    }

    /**
     * Set last name.
     * @param $lastName string
     */
    function setLastName($lastName) {
        return $this->setData('lastName', $lastName);
    }

    /**
     * Get user salutation.
     * @return string
     */
    function getSalutation() {
        return $this->getData('salutation');
    }

    /**
     * Set user salutation.
     * @param $salutation string
     */
    function setSalutation($salutation) {
        return $this->setData('salutation', $salutation);
    }

    /**
     * Get affiliation (position, institution, etc.).
     * @return string
     */
    function getAffiliation() {
        return $this->getData('affiliation');
    }

    /**
     * Set affiliation.
     * @param $affiliation string
     */
    function setAffiliation($affiliation) {
        return $this->setData('affiliation', $affiliation);
    }

    /**
     * Get country code
     * @return string
     */
    function getCountry() {
        return $this->getData('country');
    }

    /**
     * Get localized country
     * @return string
     */
    function getCountryLocalized() {
        $countryDao = & DAORegistry::getDAO('CountryDAO');
        $country = $this->getCountry();
        if ($country) {
            return $countryDao->getCountry($country);
        }
        return null;
    }

    /**
     * Set country code.
     * @param $country string
     */
    function setCountry($country) {
        return $this->setData('country', $country);
    }

    /**
     * Get email address.
     * @return string
     */
    function getEmail() {
        return $this->getData('email');
    }

    /**
     * Set email address.
     * @param $email string
     */
    function setEmail($email) {
        return $this->setData('email', $email);
    }

    /**
     * Get URL.
     * @return string
     */
    function getUrl() {
        return $this->getData('url');
    }

    /**
     * Set URL.
     * @param $url string
     */
    function setUrl($url) {
        return $this->setData('url', $url);
    }

    /**
     * Get the localized biography for this author
     */
    function getAuthorBiography() {
        return $this->getLocalizedData('biography');
    }

    /**
     * Get author biography.
     * @param $locale string
     * @return string
     */
    function getBiography($locale) {
        return $this->getData('biography', $locale);
    }

    /**
     * Set author biography.
     * @param $biography string
     * @param $locale string
     */
    function setBiography($biography, $locale) {
        return $this->setData('biography', $biography, $locale);
    }

    /**
     * Get primary contact.
     * @return boolean
     */
    function getPrimaryContact() {
        return $this->getData('primaryContact');
    }

    /**
     * Set primary contact.
     * @param $primaryContact boolean
     */
    function setPrimaryContact($primaryContact) {
        return $this->setData('primaryContact', $primaryContact);
    }

    /**
     * Get sequence of author in article's author list.
     * @return float
     */
    function getSequence() {
        return $this->getData('sequence');
    }

    /**
     * Set sequence of author in article's author list.
     * @param $sequence float
     */
    function setSequence($sequence) {
        return $this->setData('sequence', $sequence);
    }

}

?>

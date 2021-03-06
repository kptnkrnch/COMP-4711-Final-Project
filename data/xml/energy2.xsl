<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : energy.xsl
    Created on : April 4, 2014, 1:03 PM
    Author     : Joshua
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        <h3>Energy Produced</h3>
        <table>
            <xsl:call-template name="HeadingTypes" />
            <xsl:call-template name="EnergyProduced" />
        </table>
    </xsl:template>
    
    <xsl:template name="HeadingTypes">
        <tr>
            <th></th>
            <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYPRODUCED/TYPE">
                <th style="text-align: left; padding-left: 10px; padding-right: 10px;">
                    <xsl:value-of select="@source"/>
                </th>
            </xsl:for-each>
        </tr>
    </xsl:template>
    
    <xsl:template name="EnergyProduced">
        <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYPRODUCED/TYPE[1]/YEAR">
            <xsl:variable name="whichyear" select="@year"/>
            <tr>
                <th style="text-align: left;">
                    <xsl:value-of select="@year"/>
                </th>
                <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYPRODUCED/TYPE/YEAR[@year=$whichyear][1]">
                    <td style="text-align: left; padding-left: 10px; padding-right: 10px;">
                        <xsl:value-of select="./ENERGY"/>
                    </td>
                </xsl:for-each>
            </tr>
        </xsl:for-each>
    </xsl:template>

</xsl:stylesheet>

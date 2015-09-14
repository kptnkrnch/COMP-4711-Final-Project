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
        <table>
            <xsl:call-template name="HeadingYear" />
            <xsl:call-template name="EnergyProduced" />
            <xsl:call-template name="EnergyUsed" />
        </table>
    </xsl:template>
    
    <xsl:template name="HeadingYear">
        <tr>
            <th></th>
            <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYPRODUCED/TYPE[1]/YEAR">
                <th style="text-align: left; padding-left: 10px; padding-right: 10px;">
                    <xsl:value-of select="@year"/>
                </th>
            </xsl:for-each>
        </tr>
    </xsl:template>
    
    <xsl:template name="EnergyProduced">
        <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYPRODUCED/TYPE">
            <tr>
                <th style="text-align: left;">
                    <xsl:value-of select="@source"/>
                </th>
                <xsl:for-each select="./YEAR">
                    <td style="text-align: left; padding-left: 10px; padding-right: 10px;">
                        <xsl:value-of select="./ENERGY"/>
                    </td>
                </xsl:for-each>
            </tr>
        </xsl:for-each>
    </xsl:template>
    
    <xsl:template name="EnergyUsed">
        <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYUSED/RESIDENTIAL/TYPE">
            <tr>
                <th style="text-align: left;">
                    <xsl:value-of select="@source"/>
                </th>
                <xsl:for-each select="./YEAR">
                    <td style="text-align: left; padding-left: 10px; padding-right: 10px;">
                        <xsl:value-of select="./ENERGY"/>
                    </td>
                </xsl:for-each>
            </tr>
        </xsl:for-each>
        <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYUSED/INDUSTRIAL/TYPE">
            <tr>
                <th  style="text-align: left;">
                    <xsl:value-of select="@source"/>
                </th>
                <xsl:for-each select="./YEAR">
                    <td style="text-align: left; padding-left: 10px; padding-right: 10px;">
                        <xsl:value-of select="./ENERGY"/>
                    </td>
                </xsl:for-each>
            </tr>
        </xsl:for-each>
    </xsl:template>

</xsl:stylesheet>

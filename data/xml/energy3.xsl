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
        <h3>Energy Used:</h3>
        <h5>-Residential-</h5>
        <table>
            <xsl:call-template name="HeadingTypesResidential" />
            <xsl:call-template name="EnergyUsedResidential" />
        </table>
        <h5>-Industrial-</h5>
        <table style="font-size: 0.7em;">
            <xsl:call-template name="HeadingTypesIndustrial" />
            <xsl:call-template name="EnergyUsedIndustrial" />
        </table>
    </xsl:template>
    
    <xsl:template name="HeadingTypesResidential">
        <tr>
            <th></th>
            <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYUSED/RESIDENTIAL/TYPE">
                <th style="text-align: left; padding-left: 10px; padding-right: 10px;">
                    <xsl:value-of select="@source"/>
                </th>
            </xsl:for-each>
        </tr>
    </xsl:template>
    
    <xsl:template name="HeadingTypesIndustrial">
        <tr>
            <th></th>
            <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYUSED/INDUSTRIAL/TYPE">
                <th style="text-align: left; padding-left: 10px; padding-right: 10px;">
                    <xsl:value-of select="@source"/>
                </th>
            </xsl:for-each>
        </tr>
    </xsl:template>
    
    <xsl:template name="EnergyUsedResidential">
        <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYUSED/RESIDENTIAL/TYPE[1]/YEAR">
            <xsl:variable name="whichyear" select="@year"/>
            <tr>
                <th style="text-align: left;">
                    <xsl:value-of select="@year"/>
                </th>
                <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYUSED/RESIDENTIAL/TYPE/YEAR[@year=$whichyear][1]">
                    <td style="text-align: left; padding-left: 10px; padding-right: 10px;">
                        <xsl:value-of select="./ENERGY"/>
                    </td>
                </xsl:for-each>
            </tr>
        </xsl:for-each>
    </xsl:template>
    
    <xsl:template name="EnergyUsedIndustrial">
        <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYUSED/INDUSTRIAL/TYPE[1]/YEAR">
            <xsl:variable name="whichyear" select="@year"/>
            <tr>
                <th style="text-align: left;">
                    <xsl:value-of select="@year"/>
                </th>
                <xsl:for-each select="/ENERGYCONSUMPTION/ENERGYUSED/INDUSTRIAL/TYPE/YEAR[@year=$whichyear][1]">
                    <td style="text-align: left; padding-left: 10px; padding-right: 10px;">
                        <xsl:value-of select="./ENERGY"/>
                    </td>
                </xsl:for-each>
            </tr>
        </xsl:for-each>
    </xsl:template>

</xsl:stylesheet>

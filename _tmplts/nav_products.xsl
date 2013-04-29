<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet [<!ENTITY nbsp "&#160;">]>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="utf-8" indent="yes"/>
	<xsl:param name="label"/>
	<xsl:param name="bloq"/>
	<xsl:template match="/root">
		<xsl:if test="$bloq = 'person'">
			<xsl:apply-templates select="group[@label = $label]/item[@indx = 1]" mode="div"/>
			<ul>
				<xsl:apply-templates select="group[@label = $label]/item[@indx = 1]/item"  mode="li">
					<xsl:sort select="@indx" order="ascending"/>
				</xsl:apply-templates>
			</ul>
		</xsl:if>
		<!-- estate -->
		<xsl:if test="$bloq = 'estate'">
			<xsl:apply-templates select="group[@label = $label]/item[@indx = 2]" mode="div"/>
			
			<ul>
				<xsl:apply-templates select="group[@label = $label]/item[@indx = 2]/item"  mode="li">
					<xsl:sort select="@indx" order="ascending"/>
				</xsl:apply-templates>
			</ul>
		</xsl:if>
		<!-- vehicle -->
		<xsl:if test="$bloq = 'vehicle'">
			<xsl:apply-templates select="group[@label = $label]/item[@indx = 3]" mode="div"/>
			
			<ul>
				<xsl:apply-templates select="group[@label = $label]/item[@indx = 3]/item" mode="li">
					<xsl:sort select="@indx" order="ascending"/>
				</xsl:apply-templates>
			</ul>
		</xsl:if>
	</xsl:template>
	<!-- vehicle -->
	<xsl:template match="item" mode="li">
		<li>
			<xsl:choose>
				<xsl:when test="//root/@current_url = @href">
					<xsl:value-of select="@name"/>
				</xsl:when>
				<xsl:otherwise>
					<a href="{@href}"><xsl:value-of select="@name"/></a>
				</xsl:otherwise>
			</xsl:choose>
			
		</li>
	</xsl:template>
	<xsl:template match="item" mode="div">	
		<div>
			<xsl:choose>
				<xsl:when test="//root/@current_url = @href">
					<xsl:value-of select="@name"/>
				</xsl:when>
				<xsl:otherwise>
					<a href="{@href}"><xsl:value-of select="@name"/></a>
				</xsl:otherwise>
			</xsl:choose>
		</div>
	
	</xsl:template>
</xsl:stylesheet>